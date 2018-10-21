<script>
var content_DOM = document.getElementById('contents');

if( content_DOM == null )
{
    url = '<?=base_url();?>';
    url = url.replace( 'http://' + window.location.href.match(/:\/\/(.[^/]+)/)[1], '');
    complete_url = document.location.pathname;
    
    var URI_requests = complete_url.replace( url, '' );
    if( URI_requests != "" ){
    url = url + "#!/" + URI_requests;
    top.location = url;
	    
    }
}
</script>