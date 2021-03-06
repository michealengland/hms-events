/**
 * WordPress dependencies
 */
const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;

/**
 * Internal dependencies
 */
import edit from './edit';
import './style.scss';
import './editor.scss';

export default registerBlockType(
    'hms/events',
    {
	title: __( 'Events Post Feed' ),
	description: __( 'Display a custom post feed.' ),
	icon: <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M0,0h24v24H0V0z" fill="none" /><rect x="11" y="7" width="6" height="2" /><rect x="11" y="11" width="6" height="2" /><rect x="11" y="15" width="6" height="2" /><rect x="7" y="7" width="2" height="2" /><rect x="7" y="11" width="2" height="2" /><rect x="7" y="15" width="2" height="2" /><path d="M20.1,3H3.9C3.4,3,3,3.4,3,3.9v16.2C3,20.5,3.4,21,3.9,21h16.2c0.4,0,0.9-0.5,0.9-0.9V3.9C21,3.4,20.5,3,20.1,3z M19,19H5V5h14V19z" /></svg>,
	category: 'widgets',
	keywords: [
		__('posts'),
		__('post feed'),
		__('events'),
	],
	supports: {
		html: false,
	},

	getEditWrapperProps( attributes ) {
		const { align } = attributes;
		if ( 'left' === align || 'right' === align || 'wide' === align || 'full' === align ) {
			return { 'data-align': align };
		}
	},

	edit,

	save() {
		return null;
    },
} );
