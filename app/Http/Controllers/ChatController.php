<?php

namespace App\Http\Controllers;

use App\Models\Talk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index($userId = null)
    {
        $authId = auth()->id();

        // تحقق من المصادقة
        if (!$authId) {
            return redirect()->route('login');
        }

        $selectedUser = null;
        $messages = collect();

        if ($userId) {
            $selectedUser = User::find($userId);

            if ($selectedUser) {
                $messages = Talk::with(['sender', 'receiver'])
                    ->where(function($q) use($authId, $userId) {
                        $q->where('sender_id', $authId)
                            ->where('receiver_id', $userId);
                    })
                    ->orWhere(function($q) use($authId, $userId) {
                        $q->where('sender_id', $userId)
                            ->where('receiver_id', $authId);
                    })
                    ->orderBy('created_at', 'desc')
                    ->orderBy('id', 'desc') // أضف هذا

                    ->get();
            }
        }

        // الحصول على المستخدمين من نفس الفرع الذين لديهم محادثات
        $chats = Talk::where('sender_id', $authId)
            ->orWhere('receiver_id', $authId)
            ->with(['sender', 'receiver'])
            ->latest('created_at')
            ->get()
            ->map(function ($talk) use ($authId) {
                return $talk->sender_id == $authId ? $talk->receiver : $talk->sender;
            })
            ->unique('id')
            ->filter()
            ->values();

        // الحصول على جميع المستخدمين من نفس الفرع (للعرض في القائمة)
        $sameBranchUsers = User::where('branch_id', auth()->user()->branch_id)
            ->where('id', '!=', $authId)
            ->get();

        return view('managements.profile_management.chat.index', [
            'chats' => $chats,
            'messages' => $messages,
            'user' => $selectedUser,  // غيرنا الاسم إلى $selectedUser
            'sameBranchUsers' => $sameBranchUsers,
            'selectedUser' => $selectedUser  // أضفنا هذا أيضاً للتوافق
        ]);
    }
    public function store(Request $request)
    {

        Talk::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);

        return response()->json(['status' => 'success']);
    }

    public function getMessages($userId)
    {
        $authId = auth()->id();

        $messages = Talk::with(['sender', 'receiver'])
            ->where(function($q) use($authId, $userId) {
                $q->where('sender_id', $authId)
                    ->where('receiver_id', $userId);
            })
            ->orWhere(function($q) use($authId, $userId) {
                $q->where('sender_id', $userId)
                    ->where('receiver_id', $authId);
            })
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json([
            'success' => true,
            'messages' => $messages
        ]);
    }
    public function getUsersList() {
        $currentUser = auth()->user();
        $sameBranchUsers = User::where('branch_id', $currentUser->branch_id)
            ->where('id', '!=', $currentUser->id)
            ->get();

        // نمرر المتغيرات المطلوبة للـ Blade
        return view('chat.partials._users_list', compact('sameBranchUsers'))->render();
    }



}
