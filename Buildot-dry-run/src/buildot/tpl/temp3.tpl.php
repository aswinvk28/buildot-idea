<table cellpadding="0" cellspacing="0" border="1" width="200px">
  <tr>
    <td><textarea name="message" cols="85" rows="5" placeholder="share an update....."></textarea></td>
  </tr>
  <tr>
    <td><input type="image" value="Post" src="images/post-btn.png" style="padding-top: 5px;" width="46" height="23" /></td>
    <td><input type="reset" value="Cancel" style="padding-top: 5px;" width="46" height="23" /></td>
    <td><span id="FileUpload">
      <input type="file" name="file" size="24" id="BrowserHidden" onChange="getElementById('FileField').value = getElementById('BrowserHidden').value; return disableForm(this),ajaxUpload(this.form,'imageUpload.html', '','UPLOAD2'); return false;" />
      <div id="BrowserVisible">
        <input type="text" id="FileField" />
      </div>
      </span></td>
  </tr>
</table>
