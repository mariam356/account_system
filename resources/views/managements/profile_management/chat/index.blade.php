@extends('layouts.main')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/chat-left.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <br>
    <div class="chat-container">
        <div class="chat-layout">

            <!-- USERS LIST -->
            <aside class="users-panel">
                <div class="users-header">
                    <div class="header-content">
                        <i class="fas fa-comments"></i>
                        <span>{{ __('admin.chats') }}</span>

                    </div>
                    <br> <br>
                </div>

                <div class="users-search">
                    <i class="fas fa-search"></i>
                    <input type="text" id="chatSearch" placeholder="{{ __('admin.search') }}...">
                </div>
                <div class="users-list" id="usersList">
                    @php
                        // الحصول على المستخدمين من نفس الفرع
                        $currentUser = auth()->user();
                        $sameBranchUsers = App\Models\User::where('branch_id', $currentUser->branch_id)
                            ->where('id', '!=', $currentUser->id)
                            ->get();
                    @endphp

                    @forelse($sameBranchUsers as $users)
                        @php
                            // جلب آخر رسالة مع هذا المستخدم (إذا أردت)
                            $lastMessage = App\Models\Talk::where(function($query) use ($users) {
                                    $query->where('sender_id', auth()->id())
                                          ->where('receiver_id', $users->id);
                                })
                                ->orWhere(function($query) use ($users) {
                                    $query->where('sender_id', $users->id)
                                          ->where('receiver_id', auth()->id());
                                })

                                ->latest()
                                ->first();

                            // عد الرسائل غير المقروءة
                            $unreadCount = App\Models\Talk::where('sender_id', $users->id)
                                ->where('receiver_id', auth()->id())

                                ->count();
                        @endphp

                        @if(!is_null($users->image))
                            <a id="user-{{ $users->id }}" href="{{ route('chat.index', $users->id) }}"
                               class="user-item {{ isset($selectedUser) && $selectedUser->id == $users->id ? 'active' : '' }}">
                                <div
                                    class="{{ isset($selectedUser) && $selectedUser->id == $users->id ? 'active' : '' }}">

                                    <span
                                        class="avatar avatar-online"><img
                                            src="{{ asset('storage/'.$users->image) }}"
                                            onerror="this.src='{{ url('storage/profile.png')}}'"
                                        ></span>

                                    @if($unreadCount > 0)
                                        <span class="unread-badge">{{ $unreadCount }}</span>
                                    @endif
                                    @if($users->is_online)
                                        <!-- افترض أن لديك حقل is_online -->
                                        <span class="online-dot"></span>
                                    @endif
                                </div>
                                <div class="user-info">
                                    <div class="name-time">
                                        <span class="user-name">{{ $users->full_name ?? $users->name }}</span>
                                        @if($lastMessage)
                                            <span class="last-time">{{ $lastMessage->created_at->format('H:i') }}</span>
                                        @endif
                                    </div>
                                    <div class="last-msg">
                                        @if($lastMessage)
                                            <span class="text">{{ Str::limit($lastMessage->message, 25) }}</span>
                                            @if($lastMessage->sender_id == auth()->id())
                                                <i class="fas fa-check-double sent-icon"></i>
                                            @endif
                                        @else
                                            <span class="no-msg">ابدأ محادثة جديدة</span>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        @else
                            <a id="user-{{ $users->id }}" href="{{ route('chat.index', $users->id) }}"
                               class="user-item {{ isset($selectedUser) && $selectedUser->id == $users->id ? 'active' : '' }}">
                                <div
                                    class="user-avatar {{ isset($selectedUser) && $selectedUser->id == $users->id ? 'active' : '' }}">

                                    {{ strtoupper(substr($users->name,0,1)) }}

                                    @if($unreadCount > 0)
                                        <span class="unread-badge">{{ $unreadCount }}</span>
                                    @endif
                                    @if($users->is_online)
                                        <!-- افترض أن لديك حقل is_online -->
                                        <span class="online-dot"></span>
                                    @endif
                                </div>
                                <div class="user-info">
                                    <div class="name-time">
                                        <span class="user-name">{{ $users->full_name ?? $users->name }}</span>
                                        @if($lastMessage)
                                            <span class="last-time">{{ $lastMessage->created_at->format('H:i') }}</span>
                                        @endif
                                    </div>
                                    <div class="last-msg">
                                        @if($lastMessage)
                                            <span class="text">{{ Str::limit($lastMessage->message, 25) }}</span>
                                            @if($lastMessage->sender_id == auth()->id())
                                                <i class="fas fa-check-double sent-icon"></i>
                                            @endif
                                        @else
                                            <span class="no-msg">ابدأ محادثة جديدة</span>
                                        @endif
                                    </div>
                                </div>
                            </a>

                        @endif
                    @empty
                        <div class="empty-users">
                            <i class="far fa-comment-dots"></i>
                            <p>لا يوجد مستخدمين آخرين في فرعك</p>
                        </div>
                    @endforelse
                </div>

                <div class="user-profile">

                    <div class="profile-avatar">
                        {{ strtoupper(substr(auth()->user()->name,0,1)) }}
                    </div>


                    <div class="profile-info">
                        <div class="profile-name">{{ auth()->user()->name }}</div>
                        <div class="profile-status">{{ __('admin.Online_now') }}</div>
                    </div>

                </div>
            </aside>

            <!-- CHAT AREA -->
            <section class="chat-panel">


                <!-- Messages -->
                @if(!$user)
                    <div class="chat-empty">
                        <!-- ... -->
                    </div>
                @else
                    <!-- Header -->
                    <div class="chat-header">
                        <div class="header-user">
                            @if(!is_null($user->image))
                                <div>
                                        <span
                                            class="avatar avatar-online"><img
                                                src="{{ asset('storage/'.$user->image) }}"
                                                onerror="this.src='{{ url('storage/profile.png')}}'"
                                            ></span>
                                </div>
                            @else
                                <div class="user-avatar">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                            @endif
                            <div class="user-details">
                                <div class="user-name">{{ $user->full_name ?? $user->name }}</div>
                                <div class="user-status">
                                    <span class="status-text">{{ __('admin.Available_to_chat') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Messages -->
                    <div class="chat-body" id="chatBody">
                        @if($messages->count() > 0)
                            @foreach($messages as $msg)
                                @if($loop->first || !$messages[$loop->index-1]->created_at->isSameDay($msg->created_at))
                                    <div class="date-separator">
                                        <span>{{ $msg->created_at->format('d M Y') }}</span>
                                    </div>
                                @endif

                                <div class="message {{ $msg->sender_id == auth()->id() ? 'sent' : 'received' }}">
                                    @if($msg->sender_id != auth()->id())
                                        @if(!is_null($user->image))
                                            <div>

                                        <span
                                            class="avatar avatar-online"><img
                                                src="{{ asset('storage/'.$user->image) }}"
                                                onerror="this.src='{{ url('storage/profile.png')}}'"
                                            ></span>
                                            </div>
                                        @else
                                            <div class="message-avatar">

                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                        @endif

                                    @endif
                                    <div class="message-content">
                                        <div class="bubble">
                                            <div class="message-text"> {{$msg->message}}</div>
                                            <div class="message-footer">
                                                <span class="time">{{ $msg->created_at->format('H:i') }}</span>
                                                @if($msg->sender_id == auth()->id())
                                                    <i class="fas fa-check sent-icon"></i>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="no-messages">
                                <i class="far fa-comments"></i>
                                <p>{{ __('admin.No_messages_yet_Start_a_conversation') }}!</p>
                            </div>
                        @endif
                    </div>


                    <!-- Input -->
                    <form class="chat-input">

                        <div class="message-input-wrapper">
                            <input
                                type="text"
                                v-model="message"
                                placeholder="اكتب رسالتك هنا..."
                                autocomplete="off"
                            />
                        </div>

                        <button type="submit" class="send-btn" title="إرسال">
                            <i class="fas fa-paper-plane"></i>
                        </button>

                    </form>

                @endif

            </section>

        </div>
    </div>
    <br>

@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const chatBody = document.getElementById('chatBody');
            const form = document.querySelector('.chat-input');
            const input = document.querySelector('.chat-input input');

            @if($user)
            const receiverId = Number({{ $user->id }});

            let localMessages = []; // لتخزين الرسائل المرسلة حديثاً

            // إضافة رسالة للـ DOM
            function appendMessageToDOM(msg, forceSent = false) {
                const isSent = forceSent || msg.sender_id === {{ auth()->id() }};
                const user = {
                    image: @json($user->image),
                };

                const isImage = user.image;
                const div = document.createElement('div');
                div.classList.add('message', isSent ? 'sent' : 'received');

                let avatarHtml = '';
                if (!isSent) {
                    if (isImage != null) {
                        avatarHtml = `
            <span class="avatar avatar-online">
                <img src="{{ asset('storage/'.$user->image) }}"
                     onerror="this.src='{{ url('storage/profile.png') }}'">
            </span>
        `;
                    } else {
                        avatarHtml = `
            <div class="message-avatar">
                {{ strtoupper(substr($user->name,0,1)) }}
                        </div>
`;
                    }
                }


                div.innerHTML = `
            ${avatarHtml}
            <div class="message-content">
                <div class="bubble">
                    <div class="message-text">${msg.message}</div>
                    <div class="message-footer">
                        <span class="time">${new Date(msg.created_at).toLocaleTimeString([], {
                    hour: '2-digit',
                    minute: '2-digit'
                })}</span>
                        ${isSent ? '<i class="fas fa-check sent-icon"></i>' : ''}
                    </div>
                </div>
            </div>`;

                chatBody.appendChild(div);
            }

            function scrollToBottom() {
                chatBody.scrollTop = chatBody.scrollHeight;
            }

            // تحميل الرسائل عند فتح الصفحة
            function loadInitialMessages() {
                axios.get('{{ route("chat.messages", $user->id) }}')
                    .then(response => {
                        if (response.data.success && response.data.messages) {
                            chatBody.innerHTML = '';
                            response.data.messages.forEach(msg => {
                                appendMessageToDOM(msg);
                            });
                            scrollToBottom();
                        }
                    })
                    .catch(error => console.error('Error loading messages:', error));
            }

            // إرسال رسالة
            function sendMessage(event) {
                event.preventDefault();
                const messageText = input.value.trim();
                if (!messageText || !receiverId) return;

                // إنشاء رسالة محلية لعرضها فوراً
                const localMsg = {
                    sender_id: {{ auth()->id() }},
                    message: messageText,
                    created_at: new Date().toISOString()
                };
                appendMessageToDOM(localMsg, true);
                scrollToBottom();
                input.value = '';

                // إرسال الرسالة للسيرفر
                axios.post('/chat/send', {
                    receiver_id: receiverId,
                    message: messageText,
                    _token: '{{ csrf_token() }}'
                })
                    .then(response => {
                        const msg = response.data;
                        // يمكن تحديث الرسالة إذا أردت مزامنة الوقت أو أي بيانات أخرى
                    })
                    .catch(error => console.error('Error sending message:', error));
            }

            form.addEventListener('submit', sendMessage);

            loadInitialMessages();
            setInterval(loadInitialMessages, 3000);

            @endif
        });


        document.getElementById('chatSearch').addEventListener('keyup', function () {
            // 1. الحصول على النص المكتوب وتحويله لحروف صغيرة
            let filter = this.value.toLowerCase();

            // 2. تحديد قائمة المستخدمين (تأكد من تغيير الكلاس .user-item لما يناسب كودك)
            let userItems = document.querySelectorAll('.user-item');

            userItems.forEach(function (item) {
                // 3. الحصول على اسم المستخدم داخل العنصر
                let userName = item.querySelector('.user-name').textContent.toLowerCase();

                // 4. المقارنة والإخفاء/الإظهار
                if (userName.indexOf(filter) > -1) {
                    item.style.display = "";
                } else {
                    item.style.display = "none";
                }
            });
        });

    </script>

@endsection




