// Import Needed Dependencies For Gutenberg Block Settings
import { 
	useBlockProps, 
	InspectorControls, 
	ColorPaletteControl,
	AlignmentToolbar
} from '@wordpress/block-editor';
import './editor.scss';

import ServerSideRender from '@wordpress/server-side-render';
import {
	Panel,
	PanelBody,
	PanelRow,
	RadioControl,
	__experimentalNumberControl as NumberControl,
} from '@wordpress/components';

// Export Edit Function To Index.js File
// This Function Receive Properties From Gutenpride.php File
export default function Edit( data ) {

	// Functions To Update Data
	const updateStatus = ( newStatus ) => {
		data.setAttributes( { status: newStatus } );
	}
	const updateLoad = ( newLoad ) => {
		data.setAttributes( { students_to_load: newLoad } );
	}
	const updateTextColor = ( newTextColor ) => {
		data.setAttributes( { color_text: newTextColor } );
	}
	const updateBackgroundColor = ( newBackgroundColor ) => {
		data.setAttributes( { color_background: newBackgroundColor } );
	}
	const updateTextAlign = ( newTextAlign ) => {
		data.setAttributes( { text_align: newTextAlign } );
	}

	// Return Different Edit Panels
	return (
		<div { ...useBlockProps() }>
				<InspectorControls key="setting">
					<Panel>
						<PanelBody title="Settings" initialOpen={ true }>
							<PanelRow>
								{/* Show Active/Inactive Students */}
								<RadioControl
									label="Status:"
									onChange={ updateStatus }
									selected={ data.attributes.status }
									options={[
										{ label: "Active Now", value: "active" },
										{ label: "Inactive", value: "inactive" },
									]}
								/>
							</PanelRow>
							<PanelRow>
								<NumberControl
								// How Many Students To Show
									label="Number To Load:"
									onChange={ updateLoad }
									value={ data.attributes.students_to_load }
								/>
							</PanelRow>
							<PanelRow>
								<ColorPaletteControl
								// Color For The Text
									label="Text Color:"
									onChange={ updateTextColor }
									value={ data.attributes.color_text }
								/>
							</PanelRow>
							<PanelRow>
								<ColorPaletteControl
								// Color For The Background
									label="Background Color:"
									onChange={ updateBackgroundColor }
									value={ data.attributes.color_background }
								/>
							</PanelRow>
							<PanelRow>
								<AlignmentToolbar
								// Text Alignment
									label="Align Text:"
									onChange={ updateTextAlign }
									value={ data.attributes.text_align }
								/>
							</PanelRow>
						</PanelBody>
					</Panel>
				</InspectorControls>
			<ServerSideRender block='create-block/gutenpride' attributes={ data.attributes }/>
		</div>
	);
}
