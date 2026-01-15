<?php
/**
 * Models
 * php version 7.3.1.
 *
 * @category Apis
 *
 * @author   BySwadi <muath.ye@gmail.com>
 * @license  IC https://www.infinitecloud.co
 *
 * @link     Moka_Sweets https://www.mokasweets.com/
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Models
 * php version 7.3.1.
 *
 * @category Apis
 *
 * @author   BySwadi <muath.ye@gmail.com>
 * @license  IC https://www.infinitecloud.co
 *
 * @link     Moka_Sweets https://www.mokasweets.com/
 */
class Permission extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable;
    //
}
