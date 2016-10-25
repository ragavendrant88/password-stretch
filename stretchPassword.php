/**
 * StretchedPassword
 * Password generated classes
 *
 */
// Stretching Limit
define("STRETCH_COUNT", 10000);
class StretchedPassword
{
    /**
     * constructor
     *
     * @access    public
     */
    function StretchedPassword()
    {
        $this->logger = new SystemLog();
        return;
    }

    /**
     *  Obtaining the hash value of SHA256 from a string
     *
     *  @access    public
     *  @param     string    $value
     *  @return    string    hash
     */
    public static function get_sha256($value)
    {
        return hash("sha256", $value);
    }

    /**
     *  Get the stretch hash value
     *
     *  @access    public
     *  @param     string    $user_id
     *  @param     string    $password
     *  @return    string    hash
     */
    public static function get_stretched_password($user_id, $password)
    {
        $salt = StretchedPassword::get_sha256($user_id);
        $hash = "";
        for ($i=0; $i<STRETCH_COUNT; $i++) {
            $hash = StretchedPassword::get_sha256($hash . $salt . $password);
        }
        return $hash;
    }
}
