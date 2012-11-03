
function setOptionValue(value) {
	 if(value=='select') {
				var curId = $('.addtable').length;
				curId = curId ? curId-1 : ''
				$('#select'+curId).show();
		}
}
YUI().use('node', function(Y) {
	   
				var demo = Y.one('.mainTable');
				demo.delegate('click', function(evt) {
				var _elem = evt.currentTarget;
				var _rel = _elem.getAttribute('rel');
					$('#'+_rel).remove();
				}, '.remove');
				
    var onClick = function(e) {
							var curCount = demo.all('table').size();
							
       var obj;
							obj = Y.Node.create('<tr id="table'+curCount+'"><td colspan="2"><table class="addtable" id="m_none"><tr><td colspan="2" style="text-align:right!important"><a href="#" class="remove" rel=table'+curCount+' onclick="return removeFiled(this.rel);"><img src="images/close.gif" title="close" width="16px" height="16px"/></a></td></tr><tr><td>Field:-</td><td><select name="frmField[]" class="input"><option value="">Select Field</option><option value="text">Text</option><option value="email">Email</option><option value="mobile">Mobile</option><option value="select">Select</option><option value="textarea">Textarea</option><option value="radio">Radio</option><option value="checkbox">Checkbox</option></select></td></tr><tr id="select'+curCount+'" style="display:none"><td>Select option</td><td><textarea name="option[]" row="20"></textarea><br />Please enter option value sepated by comma.</td></tr><tr><td>Label</td><td><input type="text" name="label[]" value="" class="input" /></td></tr><tr><td>Value</td><td><input type="text" name="value[]" value="" class="input" /></td></tr></table></td></tr>');
							
							demo.insert(obj, Y.one('.addmore'));
    };
    Y.one('#add').on('click', onClick);
});