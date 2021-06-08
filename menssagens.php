<?php
session_start();
if(isset ($_SESSION['menssagem'])){
?>
<script>
    window.onload = function(){
        M.toast({html:'<?php echo $_SESSION['menssagem']; ?>'})
    };
</script>


<?php
}
unset ($_SESSION['menssagem']);
//session_destroy();
?>