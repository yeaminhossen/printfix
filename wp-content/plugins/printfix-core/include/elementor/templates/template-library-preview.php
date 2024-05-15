<script type="text/template" id="rr-core-liteTemplateLibrary_preview">
    <img class="liteTemplateLibrary_template-preview-thumbnail">
</script>

<script type="text/template" id="rr-core-liteTemplateLibrary_header-insert">
	<div id="elementor-template-library-header-preview-insert-wrapper" class="elementor-templates-modal__header__item">
		<a href="{{ liveurl }}" target="_blank" class="elementor-template-library-template-action header-live-preview">
			<i class="eicon-editor-external-link" aria-hidden="true"></i>
			<?php esc_html_e( 'Live Preview', 'rr-core' ); ?>
		</a>
		{{{ rr-core.library.getModal().getTemplateActionButton( obj ) }}}
	</div>
</script>