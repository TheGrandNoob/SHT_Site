<?php
        function getIp() 
        {
            $keys = [
            'HTTP_CLIENT_IP',
            'HTTP_X_FORWARDED_FOR',
            'REMOTE_ADDR'
            ];
            foreach ($keys as $key) {
            if (!empty($_SERVER[$key])) 
                {
                    $ip = trim(end(explode(',', $_SERVER[$key])));
                    if (filter_var($ip, FILTER_VALIDATE_IP))
                        return $ip;
                }
            }
        }
        
        $ip = getIp();

        $Link = mysqli_connect("localhost","root","","gameshub");
        $sql = "UPDATE words SET  w2 = true  WHERE Ip = '".$ip."'";
        $res = mysqli_query($Link,$sql);
?>

<script>
    document.location.href = "http://miztestpnzpd.tk/gameshub.php";
</script>