wp.domReady( () => {
  // image
  wp.blocks.unregisterBlockStyle('core/image','rounded');
  // table
  wp.blocks.unregisterBlockStyle('core/table', 'stripes');
  // quote
  wp.blocks.unregisterBlockStyle('core/quote', 'plain');

  wp.blocks.registerBlockStyle('core/quote', {
    name: 'bg-4',
    label: 'BG-4',
  });

  wp.richText.unregisterFormatType('core/image');
  wp.richText.unregisterFormatType('core/keyboard');
  wp.richText.unregisterFormatType('core/code');
  // wp.richText.unregisterFormatType('core/italic');
  wp.richText.unregisterFormatType('core/superscript');
  wp.richText.unregisterFormatType('core/subscript');
  // wp.richText.unregisterFormatType('core/strikethrough');
  // wp.richText.unregisterFormatType('core/bold');
  // wp.richText.unregisterFormatType('core/text-color');

  wp.data.dispatch('core/edit-post').removeEditorPanel('taxonomy-panel-post_tag'); // Tag
  wp.data.dispatch('core/edit-post').removeEditorPanel('discussion-panel'); // Comments
  // wp.data.dispatch('core/edit-post').removeEditorPanel('post-excerpt'); // Excerpt
});
