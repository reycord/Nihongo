
<div class="modal-dialog">
	<form id="versioninfo-form" method="POST">
    <div class="modal-content" style="" >
      <div class="modal-header" style="height: 50px;">
        <h4 class="modal-title">【TEST情報】</h4>
      </div>
      <div class="modal-body" style="height: 220px" >
        	<textarea style="height: 160px;padding:5px 10px; width: 100%;line-height: 100%;border: 1px solid #ccc; font-size: 13px;" readonly ><?php echo $this->data['content'] ?></textarea> 	
        	<!-- ----- --> 
        	<button type="submit" name="submit" value="save" id="save" style="width: 150px; height: 30px;">SAVE SOMETHING</button>
      </div>
    </div><!-- /.modal-content -->
    </form>
</div><!-- /.modal-dialog -->
