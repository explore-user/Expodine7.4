<div class="mini-stats-sec">
	<div class="row main_float_widget_cc">
           <?php
                                   $location=getcwd();
                                       $loc1=explode("www",$location);
                                     
                                          ?>                
	<div class="float_widget_cc">
	<div class="widget">
	<div class="mini-stats">
	<h3 style="line-height:15px;">MS C++</h3>
        <h4>.</h4>
            <?php
                                                     if (exec('wmic/output:"C:\do not delete.txt" product get Name' ));
                                                   {
                                                    $homepage = file_get_contents("C:\do not delete.txt");
                                                   $aaa="+";                       
                                              if (strpos($homepage,$aaa) === FALSE) {
                                                                                   
                                                               ?>
                   <p data-tooltip=" not installed"><span class="red-skin"><i class="fa fa-times"></i></span> not Installed </p>
                     <?php
                                                            }
                                                                   
                                                                   else
                                                                   {
                                                                    ?>
                                                                 
               <p data-tooltip=" installed"><span class="green-skin"><i class="fa fa-check"></i></span> Installed</p>
                    <?php
                                                              }
                                                        }
                                                        ?>
                                 
                               
		</div>
		</div>
                </div>
                   
		<div class="float_widget_cc">
		<div class="widget">
		<div class="mini-stats" >
		<h3 style="line-height:15px;">PORT SETTING </h3>
                <h4> wamp\bin\apache\apache2.4.9\conf\httpd.conf</h4>
               <?php
                                                               $homepage = file_get_contents($loc1[0]."bin\apache\apache2.4.9\conf\httpd.conf");

                                                if (strpos($homepage,"Listen 0.0.0.0:8021\nListen [::0]:8021") === FALSE) {
                                                            ?>
               <p data-tooltip="Required - 8021"><span class="red-skin"><i class="fa fa-times"></i></span>port not set as 8021</p>
                <?php
                                                                   }
                                                                   else
                                                                  {
                                                                    ?>
                <p data-tooltip="Required - 8021"><span class="green-skin"><i class="fa fa-check"></i></span>port set as 8021 </p>
                 <?php
                                                              }
                                                              ?>
                               
		</div>
		</div>
		</div>
                    
               <div class="float_widget_cc">
		<div class="widget">
		<div class="mini-stats" >
		<h3 style="line-height:15px;">PORT SETTING</h3>
                <h4>wamp\wampmanager.tpl</h4>
               <?php
                                        $homepage = file_get_contents($loc1[0]."wampmanager.tpl");
          $a='w_localhost}"; Action: run; FileName: "${c_navigator}"; Parameters: "http://localhost:8021/"; Glyph: 5';
          $b='w_phpmyadmin}"; Action: run; FileName: "${c_navigator}"; Parameters: "http://localhost:8021/phpmyadmin/"; Glyph: 5';
          $c='c_webgrind}"; Action: run; FileName: "${c_navigator}"; Parameters: "http://localhost:8021/webgrind/"; Glyph: 5';
                                                if (strpos($homepage,"$a") === FALSE) {
                                                            ?>
                   <p data-tooltip="Required - 8021"><span class="red-skin"><i class="fa fa-times"></i></span>localhost port not is set </p>
                       <?php
                                                                   }
                                                                   elseif(strpos($homepage,"$b") === FALSE){
                                                                       ?>
               <p data-tooltip="Required - 8021"><span class="red-skin"><i class="fa fa-times"></i></span>localhost port not is set </p>
              <?php
                                                                   }
                                                                   elseif(strpos($homepage,"$c") === FALSE){
                                                                       ?>
                <p data-tooltip="Required - 8021"><span class="red-skin"><i class="fa fa-times"></i></span>localhost port not is set </p>
                <?php
                                                                   }
                                                                   else
                                                                  {
                                                                    ?>
               <p data-tooltip="Required - 8021"><span class="green-skin"><i class="fa fa-check"></i></span>localhost port is set </p>
               <?php
                                                              }
                                                              ?>
                                                               
               </div>
		</div>
		</div>
                    
        <div class="float_widget_cc">
	<div class="widget">
	<div class="mini-stats" >
	<h3 style="line-height:15px;">PORT SETTING</h3>
         <h4>wamp\wampmanager.ini</h4>
          <?php
                                        $homepage = file_get_contents($loc1[0]."wampmanager.ini");
          $aa='http://localhost:8021/"; Glyph: 5';
          $ab='http://localhost:8021/phpmyadmin/"; Glyph: 5';
          $ac='http://localhost:8021/webgrind';
                                                if (strpos($homepage,"$aa") === FALSE) {
                                                            ?>
                <p data-tooltip="Required - 8021"><span class="red-skin"><i class="fa fa-times"></i></span>localhost port not is set </p>
                     <?php
                                                                   }
                                                                  elseif(strpos($homepage,"$ab") === FALSE){
                                                                       ?>
              <p data-tooltip="Required - 8021"><span class="red-skin"><i class="fa fa-times"></i></span>localhost port not is set </p>
                     <?php
                                                                   }
                                                                   elseif(strpos($homepage,"$ac") === FALSE){
                                                                       ?>
                  <p data-tooltip="Required - 8021"><span class="red-skin"><i class="fa fa-times"></i></span>localhost port not is set </p>
                   <?php
                                                                   }
                                                                   else
                                                                  {
                                                                    ?>
                 <p data-tooltip="Required - 8021"><span class="green-skin"><i class="fa fa-check"></i></span>localhost port is set </p>
                   <?php
                                                              }
                                                              ?>
                                                               
	</div>
	</div>
	</div>
                    
        <div class="float_widget_cc">
	<div class="widget">
	<div class="mini-stats" >
	<h3 style="line-height:15px;">SECURE CONFIGURATION</h3>
       <h4>wamp\apps\phpmyadmin4.1.14\config.inc.php</h4>
            <?php
                                        $homepage = file_get_contents($loc1[0]."apps\phpmyadmin4.1.14\config.inc.php");
                                    $abc='//$cfg[\'Servers\'][$i][\'auth_type\'] = \'config\';';
         
                                                if (strpos($homepage,"$abc") === FALSE) {
                                                            ?>
                <p data-tooltip="secure- configuration not done"><span class="red-skin"><i class="fa fa-times"></i></span>secure configuration not done</p>
                    <?php
                                                                   }
                                                                  
                                                                   else
                                                                  {
                                                                    ?>
                <p data-tooltip="secure configuration done"><span class="green-skin"><i class="fa fa-check"></i></span> secure configuration done</p>
             <?php
                                                              }
                                                              ?>
                                                               
		</div>
		</div>
		</div>
                    
                    
              <div class="float_widget_cc">
		<div class="widget">
		<div class="mini-stats" >
                                                          
                                                            
	<h3 style="line-height:15px;">PHPMYADMIN VALUE SETTINGS</h3>
         <h4>wamp\bin\apache\apache2.4.9\bin\php.ini</h4>
                                                               
          <?php
                             $homepage = file_get_contents($loc1[0]."bin\apache\apache2.4.9\bin\php.ini");
          $a1='post_max_size = 1000M';
          $a2='upload_max_filesize = 664M';
          $a3='memory_limit = 1280M';
          $a4='max_execution_time = 259200';
          $a5='max_input_time = 259200';   
	  $a6='session.gc_maxlifetime = 2500';	  
          
                                      if (strpos($homepage,"$a1") === FALSE) {
                                                            ?>
                     <p data-tooltip="Required - "><span class="red-skin"><i class="fa fa-times"></i></span></p>
                                <?php
                                                                   }
                                                                  elseif(strpos($homepage,"$a2") === FALSE){
                                                                       ?>
                     <p data-tooltip="Required - "><span class="red-skin"><i class="fa fa-times"></i></span>values not set</p>
                  <?php
                                                                   }
                                                                   elseif(strpos($homepage,"$a3") === FALSE){
                                                                       ?>
                 <p data-tooltip="Required - "><span class="red-skin"><i class="fa fa-times"></i></span>values not set  </p>
                        <?php
                                                                   }
                                                                    elseif(strpos($homepage,"$a4") === FALSE){
                                                                       ?>
                   <p data-tooltip="Required - "><span class="red-skin"><i class="fa fa-times"></i></span>values not set  </p>
                      <?php
                                                                   }
                                                                   elseif(strpos($homepage,"$a5") === FALSE){
                                                                       ?>
              <p data-tooltip="Required - "><span class="red-skin"><i class="fa fa-times"></i></span>values not set  </p>
                  <?php
                                                                   }
                                                                   elseif(strpos($homepage,"$a6") === FALSE){
                                                                       ?>
                   <p data-tooltip="Required - 1"><span class="red-skin"><i class="fa fa-times"></i></span>values not set </p>
                      <?php
                                                                   }
                                                                   else
                                                                  {
                                                                    ?>
                  <p data-tooltip="value all set"><span class="green-skin"><i class="fa fa-check"></i></span>values set </p>
                         <?php
                                                              }
                                                              ?>
                                                               
 	</div>
	</div>
	</div>
          <div class="float_widget_cc">
	<div class="widget">
	<div class="mini-stats" >
	<h3 style="line-height:15px;">SOURCE GUARDIAN </h3>
          <h4>1.wamp\bin\php\php5.5.12\ext<br/> 2. wamp\bin\php\php5.5.12 <br/> 3.wamp\bin\apache\apache2.4.9\bin\php.ini</h4>
              <?php
                                        $homepage = file_get_contents($loc1[0]."bin\apache\apache2.4.9\bin\php.ini");
                                        $homepage1 = file_exists($loc1[0]."bin\php\php5.5.12\ixed.5.5ts.win");
                                        $homepage2 = file_exists($loc1[0]."bin\php\php5.5.12/ext/ixed.5.5ts.win");
                                        
          $s1='[sourceguardian]';
          $s2='extension=ixed.5.5ts.win';
          
         
                                                if (strpos($homepage,"$s1") === FALSE) {
                                                            ?>
               <p data-tooltip="source guardian not ok"><span class="red-skin"><i class="fa fa-times"></i></span>Source guardian not ok</p>
                     <?php
                                                                   }
                                                                    elseif(strpos($homepage,"$s2") === FALSE){
                                                                       ?>
           <p data-tooltip="not ok"><span class="red-skin"><i class="fa fa-times"></i></span>Source guardian not ok after pasting the data</p>
               <?php
                                                                   }
                                                                  else if(!$homepage1){
                                                                       ?>
           <p data-tooltip="not ok"><span class="red-skin"><i class="fa fa-times"></i></span>Source guardian not ok in bin</p>
                  <?php
                                                                   }
                                                                   else if(!$homepage2){
                                                                       ?>
             <p data-tooltip="not ok"><span class="red-skin"><i class="fa fa-times"></i></span>Source guardian not ok in ext</p>
                    <?php
                                                                   }
                                                                   else
                                                                  {
                                                                    ?>
                 <p data-tooltip="source guardian ok  "><span class="green-skin"><i class="fa fa-check"></i></span> Source guardian ok </p>
                    <?php
                                                              }
                                                              ?>
                                                               
	</div>
	</div>
	</div>
                                    
                                    
          <div class="float_widget_cc">
	<div class="widget">
	<div class="mini-stats">
	<h3 style="line-height:15px;">LAN CONNECTION</h3>
             <h4>connection test</h4>
                             
            <?php
                                        $a='192.168.1.1';
                                          $b='192.168.0.1';
                                           $c='10.0.0.1';
                                         if  (exec("ping -n 1 -w 1 ".$a, $output, $result)||exec("ping -n 1 -w 1 ".$b, $output, $result)||exec("ping -n 1 -w 1 ".$c, $output, $result));
             
                                   if ($result !== 0)
                                    {
                                                                    ?>
                 <p data-tooltip="lan not ok"><span class="red-skin"><i class="fa fa-times"></i></span>lan connection not ok</p>
                 <?php
                                                                   }
                                                                  
                                                                   else
                                                                  {
                                                                    ?>
              <p data-tooltip=" lan connection ok"><span class="green-skin"><i class="fa fa-check"></i></span> lan connection ok</p>
                  <?php
                                                              }
                                                              ?>
                                
                                
		</div>
                </div>
		</div>     
                   <div class="float_widget_cc">
		<div class="widget">
	<div class="mini-stats" >
	<h3 style="line-height:15px;">DATABASE CHECKING </h3>
            <h4>D:\wamp\bin\mysql\mysql5.6.17\data\expodine</h4>
                    <?php
                                                                       $database = file_exists($loc1[0]."bin\mysql\mysql5.6.17\data/expodine");
                                                
                                                   if (!$database)  {
                                                      
                                                            ?>
             <p data-tooltip="DATABASE NOT FOUND"><span class="red-skin"><i class="fa fa-times"></i></span>Database not found</p>
                <?php
                                                                   }
                                                                   else
                                                                  {
                                                                     
                                                                    ?>
               <p data-tooltip="DATABASE FOUND"><span class="green-skin"><i class="fa fa-check"></i></span>Database found </p>
                <?php
                                                              }
                                                              ?>
                 </div>
		</div>
		</div>
                                    
<!--                                             <div class="float_widget_cc">
						<div class="widget">
							<div class="mini-stats" >
								<h3 style="line-height:15px;">XML PERMISSIONS </h3>
                                                               
                                                             
                                                                       <?php
                                                                             
                                                             $url=$loc1[0]."www/expodine/xml/menus.xml";   
                                                             $lastWord = substr($url,strrpos($url, '/') + 24);  
                                                                
                                                               if (file_exists($url)) {
                                                                  
                                                                  echo ' * File Exist    ';
                                                                    if (!is_writable($url)) {
                                                                        echo "<br />";
                                                                       echo '* File not writable ';
                                                                        
                                                                        if (!is_readable($url)) {
                                                                            echo "<br />";
                                                                            echo " * File Not Readable";
                                                                            
                                                                          }
                                                                        else{
                                                                            echo "<br />";
                                                                            echo ' *  File Readable';
                                                                        }
                                                                        }
                                                                        
                                                                    else{
                                                                    echo 'File Writable';
                                                                    } 
                                                                    }
                                                                    
                                                                else{
                                                                echo ' * File not exist';
                                                                echo "<br />";
                                                                }
                                                              
                                                                       ?>                                                                      
                                                               
							</div>
						</div>
					</div>-->
                                     
                                    
			
                                
                  </div>
						<!-- Mini stats Sec -->
		</div>