<?php
ini_set('error_reporting', E_ALL | E_STRICT);
ini_set('display_errors', 'On');
?>
<!DOCTYPE html>
<html>
<head>
    <title>MapApp TechDemo</title>
    
    <link href="lib/style.css" rel="stylesheet" />
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js"></script>
    <script src="lib/plugins/jquery.dragscrollable-master/dragscrollable.js"></script>
    <script src="lib/script.js"></script>
</head>

<body>
    
<?php
include_once ("lib/mapApp_Core.php");
$map = mapApp_getMap();
print $map;
?>

</body>
</html>