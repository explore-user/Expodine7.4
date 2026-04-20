
<div style="width: 98%">
                            <span style="font-size: 15px"> 
                             CONNECTED  LAN IP NETWORK  
                        </span>
              <pre  class="xdebug-var-dump" dir="ltr" style=" overflow-x: hidden;font-size: 11px;color: darkred;height: 400px;" >
              
 <?php
              


// 1) Find your local IP
$local_ip = getHostByName(getHostName());

// Example: "192.168.10.55"
echo "*** SYSTEM IP : $local_ip ***<br>";

// 2) Extract subnet prefix (first 3 octets)
$parts = explode('.', $local_ip);

// subnet: "192.168.10."
$subnet = $parts[0] . "." . $parts[1] . "." . $parts[2] . ".";

echo " Scanning subnet: $subnet.x<br><br>";

// 3) Ping 1–254 on detected network
for ($i = 1; $i <=1; $i++) {
    exec("ping -n 1 -w 40 " . $subnet . $i);
}
sleep(1);
// 4) Read ARP results
exec('arp -a', $lines);

foreach ($lines as $line) {

    if (preg_match('/(\d+\.\d+\.\d+\.\d+)\s+([A-Fa-f0-9\-]{17})/', $line, $m)) {

        $ip  = trim($m[1]);
        $mac = strtoupper(str_replace('-', ':', $m[2]));

        //echo "IP : $ip  &nbsp; & &nbsp; Address : $mac<br>";
        
        printf("Connected Ip : %-15s Address : %s<br>", $ip, $mac);
        
    }
}

?>
            
</pre>
</div> 
