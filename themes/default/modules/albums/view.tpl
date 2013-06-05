<!-- BEGIN: main -->
<div id="albums">
	<div class="view_albums">
    	{AL_NAME} 
    	<span style="font-size:11px; color:#999; font-weight:normal">{NUM_PHOTO} photos | {NUM_VIEW} view</span><br />
    </div>
    <div class="mod_content">
      <!-- BEGIN: row -->
      <div class="items_rows_adv">
          <!-- BEGIN: album -->
          <div class="items_cell">
              <!-- BEGIN: img -->
              <a href="{SRC_LAGE}" title="{DES}" rel="shadowbox[miss]"><img src="{SRC}" alt="" /></a><br />
              <!-- END: img -->
              <span class="title_nums">{NAME}</span><br />
          </div>
          <!-- END: album -->
          <div class="clear"></div>
      </div>
      <!-- END: row -->
    </div>
    <!-- BEGIN: pages -->
    <div class="mod_title">{PAGES}</div>
    <!-- END: pages -->
</div>
<!-- END: main -->