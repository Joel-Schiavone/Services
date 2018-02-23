
<!DOCTYPE html>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<?php
require_once('validacion.php'); 
require_once('inc/conectar.php');
require_once('modules/classes.php');

?>
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/jquery.jOrgChart.css"/>
    <link rel="stylesheet" href="css/custom.css"/>
    <link href="css/prettify.css" type="text/css" rel="stylesheet" />
    <script type="text/javascript" src="prettify.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
    <script src="jquery.jOrgChart.js"></script>
    <script>
    jQuery(document).ready(function() {
        $("#org").jOrgChart({
            chartElement : '#chart',
            dragAndDrop  : true
        });
    });
    </script>
  </head>
  <body onload="prettyPrint();">
            <?php
                
                $cliente='189';
                     
                   
                             $sql1         =  "SELECT * FROM clientes_organizacion WHERE ID_cli=$cliente and org_dependencia=0";
                             $resultA     =  mysql_query($sql1);
                             $resultA1    =  mysql_fetch_assoc($resultA);
                             $ID_org1      =  $resultA1['ID_org'];

                                        echo "<ul  id='org' style='display:none'>";
                                        echo    "<li ><br>";
                                        echo        $resultA1['org_puesto'];
                                        echo        "<hr>";
                                      
                                      
                                        echo        $resultA1['org_nombre'];
                                        echo        "<hr>";
                                         echo        "<a href='#' style='float: right; margin-right:5px; margin-bottom: 5px; margin-top: -10px;'>Ver mas</a>";
                                        echo     "<ul>";  
                                   
                                     $sql2      =   "SELECT * FROM clientes_organizacion WHERE ID_cli=$cliente and org_dependencia=$ID_org1";
                                     $resultB  =   mysql_query($sql2);
                                     while ($resultB1=mysql_fetch_assoc($resultB)) 
                                        {
                                            $ID_org2      =  $resultB1['ID_org'];
                                            echo            "<li id='".$resultB1['ID_org']."'><br>";
                                            echo        $resultB1['org_puesto'];
                                            echo        "<hr>";
                                      
                                      
                                            echo        $resultB1['org_nombre'];
                                            echo        "<hr>";
                                            echo        "<a href='#' style='float: right; margin-right:5px; margin-bottom: 5px; margin-top: -10px;'>Ver mas</a>";
                                            echo     "<ul>";     
                                          
                                       
                                             $sql3      =   "SELECT * FROM clientes_organizacion WHERE ID_cli=$cliente and org_dependencia=$ID_org2";
                                             $resultC   =   mysql_query($sql3);
                                             while ($resultC1=mysql_fetch_assoc($resultC)) 
                                                {
                                                $ID_org3      =  $resultC1['ID_org'];
                                                echo            "<li id='".$resultC1['ID_org']."'><br>";
                                                echo        $resultC1['org_puesto'];
                                                echo        "<hr>";
                                      
                                      
                                                echo        $resultC1['org_nombre'];
                                                echo        "<hr>";
                                                echo        "<a href='#' style='float: right; margin-right:5px; margin-bottom: 5px; margin-top: -10px;'>Ver mas</a>";
                                                echo     "<ul>";   

                                                     $sql4     =   "SELECT * FROM clientes_organizacion WHERE ID_cli=$cliente and org_dependencia=$ID_org3";
                                                     $resultD  =   mysql_query($sql4);
                                                     while ($resultD1=mysql_fetch_assoc($resultD)) 
                                                        {
                                                        
                                                        echo            "<li id='".$resultD1['ID_org']."'><br>";
                                                       echo        $resultD1['org_puesto'];
                                                        echo        "<hr>";
                                                      
                                                      
                                                        echo        $resultD1['org_nombre'];
                                                        echo        "<hr>";
                                                         echo        "<a href='#' style='float: right; margin-right:5px; margin-bottom: 5px; margin-top: -10px;'>Ver mas</a>";
                                                        

                                                        } 
                                                     echo "</li>";   
                                                     echo    "</ul>";        

                                                } 
                                                 echo "</li>";
                                                 echo    "</ul>";
                                         } 
                                        echo "</li>";
                                        echo "</ul>";
                                        echo "</li>";
                                        echo "</ul>";                 
                                                 
              ?>
    <div id="chart" class="orgChart"></div>
    <script>
        jQuery(document).ready(function() {
            
            /* Custom jQuery for the example */
            $("#show-list").click(function(e){
                e.preventDefault();
                
                $('#list-html').toggle('fast', function(){
                    if($(this).is(':visible')){
                        $('#show-list').text('Hide underlying list.');
                        $(".topbar").fadeTo('fast',0.9);
                    }else{
                        $('#show-list').text('Show underlying list.');
                        $(".topbar").fadeTo('fast',1);                  
                    }
                });
            });
            $('#list-html').text($('#org').html());
            
            $("#org").bind("DOMSubtreeModified", function() {
                $('#list-html').text('');
                
                $('#list-html').text($('#org').html());
                
                prettyPrint();                
            });
        });
    </script>
</body>
</html>