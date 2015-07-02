<script language="javascript">
    function addNovoFicheiro() {
        //--------------------------------------------------------------------------------------------------------------------------------------
        var input = document.createElement('INPUT');
        var lineBreak = document.createElement('BR');
        //--------------------------------------------------------------------------------------------------------------------------------------
        input.setAttribute('type', 'file');
        input.setAttribute('name', 'pictures[]');
        document.getElementById('linhas').appendChild(input);
        document.getElementById('linhas').appendChild(lineBreak);
        //--------------------------------------------------------------------------------------------------------------------------------------
    }
</script>

<form enctype="multipart/form-data" action="<?php echo basename($_SERVER['PHP_SELF']); ?>" method="POST">
    <input type="hidden" name="MAX_FILE_SIZE" value="1024000"/>
    <input type="file" name="pictures[]"/>

    <div id="linhas"></div>
    <hr>
    <input class="btn" type="button" name="button" id="button" value="More Files"
           onClick='addNovoFicheiro();window.scroll(0,document.body.offsetHeight);'>
    <input type="submit" value="~!UPLOAD!~"/>
</form>

 

