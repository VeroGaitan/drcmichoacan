<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Example of Bootstrap 3 Modal Sizes</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<style type="text/css">
    .bs-example{
    	margin: 20px;
    }
</style>
<script>
 function msjDialog(msj) {
        $("<div/>").dialog({
           resizable: false,
            modal: true,
            width: 300,
            buttons: {
                OK: function () {
                    $(this).dialog("destroy");
                }
            },
            close: function () {
                $(this).dialog("destroy").html("").remove();
            }
        }).prepend(msj).css("text-align", "center").prev(".ui-dialog-titlebar").hide();
    }
</script>
</head>
<body>
    <?php
    echo msjDialog('kl ks djkf bdjksfb jsdbf');
    //include 'Menu.html';
    ?>
<div class="bs-example">
    <!-- Large modal -->
	<button class="btn btn-primary" data-toggle="modal" data-target="#largeModal">Large modal</button>
 
    <div id="largeModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Large Modal</h4>
                </div>
                <div class="modal-body">
                    <p>Add the <code>.modal-lg</code> class on <code>.modal-dialog</code> to create this large modal.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">OK</button>
                </div>
            </div>
        </div>
    </div>
     
    <!-- Small modal -->
    <button class="btn btn-primary" data-toggle="modal" data-target="#smallModal">Small modal</button>
     
    <div id="smallModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Small Modal</h4>
                </div>
                <div class="modal-body">
                    <p>Add the <code>.modal-sm</code> class on <code>.modal-dialog</code> to create this small modal.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">OK</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!--    http://www.tutorialrepublic.com/twitter-bootstrap-tutorial/bootstrap-modals.php-->
</body>
</html>                                		                                		