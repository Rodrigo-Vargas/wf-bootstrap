/**
 * WordPress dependencies
 */
const { __ } = wp.i18n;
const { Component, Fragment } = wp.element;
const {
   RichText,
   URLInput,
   InspectorControls,
   BlockControls,
   AlignmentToolbar,
} = wp.blockEditor || wp.editor; // Fallback to 'wp.editor' for backwards compatibility
const { Dashicon, IconButton, SelectControl, PanelBody } = wp.components;
const { applyFilters } = wp.hooks;

class BootstrapButtonEdit extends Component {
   render() {
      const { attributes, className, setAttributes, isSelected } = this.props;
      const { url, text, style, alignment } = attributes;

      let styleOptions = [
         { label: __('Primary', 'wf-bootstrap'), value: 'primary' },
         { label: __('Secondary', 'wf-bootstrap'), value: 'secondary', },
         { label: __('Primary Outline', 'wf-bootstrap'), value: 'outline-primary', },
         { label: __('Secondary Outline', 'wf-bootstrap'), value: 'outline-secondary', },
      ];
      styleOptions = applyFilters(
         'wfBootstrap.button.styleOptions',
         styleOptions
      );

      return (
         <Fragment>
            <div className={className} data-alignment={alignment}>
               <RichText
                  // eslint-disable-next-line @wordpress/i18n-ellipsis
                  placeholder={__(
                     'Add text...',
                     'wf-bootstrap'
                  )}
                  value={text}
                  onChange={(value) =>
                     setAttributes({ text: value })
                  }
                  formattingControls={[]}
                  keepPlaceholderOnFocus
               />
               <InspectorControls>
                  <PanelBody>
                     <SelectControl
                        label={__('Style', 'wf-bootstrap')}
                        value={style}
                        options={styleOptions}
                        onChange={(selectedStyle) => {
                           setAttributes({ style: selectedStyle });
                        }}
                     />
                  </PanelBody>
               </InspectorControls>
               <BlockControls>
                  <AlignmentToolbar
                     value={alignment}
                     label={__(
                        'Change button alignment',
                        'wf-bootstrap'
                     )}
                     onChange={(newAlignment) =>
                        setAttributes({ alignment: newAlignment })
                     }
                  />
               </BlockControls>
            </div>
            {isSelected && (
               <form
                  className="wp-block-wf-bootstrap-button-link"
                  onSubmit={(event) => event.preventDefault()}
               >
                  <Dashicon icon="admin-links" />
                  <URLInput
                     value={url}
                     onChange={(value) =>
                        setAttributes({ url: value })
                     }
                  />
                  <IconButton
                     icon="editor-break"
                     label={__('Apply', 'wf-bootstrap')}
                     type="submit"
                  />
               </form>
            )}
         </Fragment>
      );
   }
}

export default BootstrapButtonEdit;
