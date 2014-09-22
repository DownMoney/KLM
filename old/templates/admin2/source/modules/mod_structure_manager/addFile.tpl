<html>
<head>
<meta http-equiv="Content-Language" content="pl"> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" href="{$__cssRoot__}/main.css" type="text/css">
	<title>Dodaj pliki</title>	
	<link rel="stylesheet" href="{$__cssRoot__}/plupload.queue.css" type="text/css" media="screen" />
<script type="text/javascript" src="{$__BaseJsRoot__}/plupload/jquery.min.js"></script>
<script type="text/javascript" src="{$__BaseJsRoot__}/plupload/plupload.full.min.js"></script>
<script type="text/javascript" src="{$__BaseJsRoot__}/plupload/jquery.plupload.queue.min.js"></script>
</head> 
<body> 
{$addFile_form} 

<script type="text/javascript">
{literal}
plupload.addI18n({
	'Select files' : 'Dodaj pliki',
	'Add files to the upload queue and click the start button.' : 'Dodaj pliki do kolejki pobierania i kliknij przycisk Start.',
	'Filename' : 'Nazwa pliku',
	'Status' : 'Status',
	'Size' : 'Rozmiar',
	'Add files' : 'Dodaj pliki',
	'Stop current upload' : 'Zatrzymaj wysyłanie',
	'Start uploading queue' : 'Start',
	'Drag files here.' : 'Przeciągnij tutaj pliki'
});
	// Setup flash version
	var uploader = $("#flashcontent").pluploadQueue({
		// General settings
		runtimes : 'flash',
		url : '{/literal}{wt_href_tpl_link mod_key="home"}modules/free_files/upload.php?fID={$smarty.get.fID}{literal}',
		max_file_size : '{/literal}{$max_upload_size}{literal}mb',
		chunk_size : '100kb',
		unique_names : false,
		// Flash settings
		flash_swf_url : '{/literal}{$__BaseJsRoot__}{literal}/plupload/plupload.flash.swf'
	});
	
	var uploader = $('#flashcontent').pluploadQueue();
    uploader.bind('FileUploaded', function(up, file, res) {
        
		 parent.$('operation2').src = '{/literal}{wt_href_tpl_link mod_key="mod_structure_manager" parameters="a=fileSaved&multiple=`$smarty.get.multiple`&add_on=`$smarty.get.add_on`&fID=`$smarty.get.fID`&file='+file.name+'"}{literal}';
			
        if(this.total.queued == 0) {
           parent.Dialog.closeInfo();
        }
    });

{/literal}
</script>
</body>
</html>