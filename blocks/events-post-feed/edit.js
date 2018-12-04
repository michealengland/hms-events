/**
 * External dependencies
 */
import isUndefined from 'lodash/isUndefined';
import pickBy from 'lodash/pickBy';
import moment from 'moment';
import classnames from 'classnames';

/**
 * WordPress dependencies
 */
const { Component, Fragment } = wp.element;
const {
	PanelBody,
	Placeholder,
	QueryControls,
	RangeControl,
	Spinner,
	SelectControl,
	ToggleControl,
	Toolbar,
} = wp.components;
const  { __ } = wp.i18n;
const { decodeEntities } = wp.htmlEntities;
const {
	InspectorControls,
	BlockAlignmentToolbar,
	BlockControls,
	RichText
} = wp.editor;
const {
	withSelect,
} = wp.data;

const MAX_POSTS_COLUMNS = 6;

function onChangeHeader( newEventHeader ) {
	setAttributes( { eventHeader: newEventHeader } );
}

class EventsPostsFeedEdit extends Component {
	constructor() {
		super( ...arguments );
		this.toggleDisplayPostDate = this.toggleDisplayPostDate.bind( this );
		this.toggleDisplayStartDate = this.toggleDisplayStartDate.bind( this );
		this.toggleDisplayEndDate = this.toggleDisplayEndDate.bind( this );
		this.toggleDisplayPostImage = this.toggleDisplayPostImage.bind( this );
		this.toggleDisplayAddress = this.toggleDisplayAddress.bind( this );
		this.toggleMapLink = this.toggleMapLink.bind( this );
	}

	toggleDisplayPostDate() {
		const { displayPostDate } = this.props.attributes;
		const { setAttributes } = this.props;

		setAttributes( { displayPostDate: ! displayPostDate } );
	}

	toggleDisplayStartDate() {
		const { displayStartDate } = this.props.attributes;
		const { setAttributes } = this.props;

		setAttributes( { displayStartDate: ! displayStartDate } );
	}

	toggleDisplayEndDate() {
		const { displayEndDate } = this.props.attributes;
		const { setAttributes } = this.props;

		setAttributes( { displayEndDate: ! displayEndDate } );
	}
	
	toggleDisplayPostImage() {
		const { displayPostImage } = this.props.attributes;
		const { setAttributes } = this.props;

		setAttributes( { displayPostImage: ! displayPostImage } );
	}

	toggleDisplayAddress() {
		const { displayAddress } = this.props.attributes;
		const { setAttributes } = this.props;

		setAttributes( { displayAddress: ! displayAddress } );
	}

	toggleMapLink() {
		const { displayMapLink } = this.props.attributes;
		const { setAttributes } = this.props;

		setAttributes( { displayMapLink: ! displayMapLink } );
	}


    
	render() {
		const { attributes, categoriesList, setAttributes, latestPosts } = this.props;
		const { displayPostDate, displayStartDate, displayEndDate, displayPostImage, displayAddress, displayMapLink, eventHeader, imageCrop, align, postLayout, columns, order, orderBy, categories, postsToShow, startDate } = attributes;

		// Thumbnail options
		const imageCropOptions = [
			{ value: 'landscape', label: __( 'Landscape' ) },
			{ value: 'square', label: __( 'Square' ) },
		];

		const isLandscape = imageCrop === 'landscape';

		const inspectorControls = (
			<InspectorControls>
				<PanelBody title={ __( 'Event Post Settings' ) } >

					<QueryControls
						{ ...{ order, orderBy, } }
						numberOfItems={ postsToShow }
						categoriesList={ categoriesList }
						selectedCategoryId={ categories }
						//onOrderChange={ ( value ) => setAttributes( { order: value } ) }
						//onOrderByChange={ ( value ) => setAttributes( { orderBy: value } ) }
						onCategoryChange={ ( value ) => setAttributes( { categories: '' !== value ? value : undefined } ) }
						onNumberOfItemsChange={ ( value ) => setAttributes( { postsToShow: value } ) }
					/>

					<ToggleControl
						label={ __( 'Display Featured Image' ) }
						checked={ displayPostImage }
						onChange={ this.toggleDisplayPostImage }
					/>
					
					<ToggleControl
						label={ __( 'Display event starting time.' ) }
						checked={ displayStartDate }
						onChange={ this.toggleDisplayStartDate }
					/>

					<ToggleControl
						label={ __( 'Display event ending time.' ) }
						checked={ displayEndDate }
						onChange={ this.toggleDisplayEndDate }
					/>

					<ToggleControl
						label={ __( 'Display Location Details' ) }
						checked={ displayAddress }
						onChange={ this.toggleDisplayAddress }
					/>

					<ToggleControl
						label={ __( 'Display Google Maps Link' ) }
						checked={ displayMapLink }
						onChange={ this.toggleMapLink }
					/>

					{ postLayout === 'grid' &&
						<RangeControl
						label={ __( 'Columns' ) }
						value={ columns }
						onChange={ ( value ) => setAttributes( { columns: value } ) }
						min={ 2 }
						max={ ! hasPosts ? MAX_POSTS_COLUMNS : Math.min( MAX_POSTS_COLUMNS, latestPosts.length ) }
						/>
					}
				</PanelBody>
			</InspectorControls>
		);

		const hasPosts = Array.isArray( latestPosts ) && latestPosts.length;
		if ( ! hasPosts ) {
			return (
				<Fragment>
					{ inspectorControls }
					<Placeholder
						icon="admin-post"
						label={ __( 'Latest Posts' ) }
					>
						{ ! Array.isArray( latestPosts ) ?
							<Spinner /> :
							__( 'No posts found.' )
						}
					</Placeholder>
				</Fragment>
			);
		}

		// Removing posts from display should be instant.
		const displayPosts = latestPosts.length > postsToShow ?
			latestPosts.slice( 0, postsToShow ) :
			latestPosts;

		const layoutControls = [
			{
				icon: 'list-view',
				title: __( 'List View' ),
				onClick: () => setAttributes( { postLayout: 'list' } ),
				isActive: postLayout === 'list',
			},
			{
				icon: 'grid-view',
				title: __( 'Grid View' ),
				onClick: () => setAttributes( { postLayout: 'grid' } ),
				isActive: postLayout === 'grid',
			},
		];
		

		return (
			<Fragment>
				{ inspectorControls }
				<BlockControls>
					<BlockAlignmentToolbar
						value={ align }
						onChange={ ( nextAlign ) => {
							setAttributes( { align: nextAlign } );
						} }
						controls={ [ 'center', 'wide', 'full' ] }
					/>
					<Toolbar controls={ layoutControls } />
				</BlockControls>

				<RichText
					tagName="h2"
					onChange={ onChangeHeader }
					value={ eventHeader }
					placeholder="Events"
				/>

				<ul
				className={ classnames( this.props.className, 'wp-block-latest-posts', {
					'is-grid': postLayout === 'grid',
					[ `columns-${ columns }` ]: postLayout === 'grid',
				} ) }
				>
					{ displayPosts.map( ( post, i ) =>
						
						<li
						key={ i }
						className={ classnames(
							post.featured_image_src && displayPostImage ? 'has-featured': ''
						) }
						>

						{
							displayPostImage && post.featured_image_src !== undefined && post.featured_image_src ? (
							<div class="hms-block-post-grid-image">
								<img
								src={ post.featured_image_src_square }
								alt={ decodeEntities( post.title.rendered.trim() ) || __( '(Untitled)' ) }
								/>
							</div>	
							) : (
								null
							)
						}

						<a href={ post.link } target="_blank">{ decodeEntities( post.title.rendered.trim() ) || __( '(Untitled)' ) }</a>

						{
							// Event Start Date 
							<p>{ (displayStartDate && post.acf.event_date_start !== undefined && post.acf.event_date_start ? "Start: "+post.acf.event_date_start : null ) }</p> 
						}
						
						{
							// Event End Date 
							<p>{ (displayEndDate && post.acf.event_date_end !== undefined && post.acf.event_date_end ? "End: "+post.acf.event_date_end : null ) }</p>
						}
						
						{
							// Location Title
							<p>{ (displayAddress && post.acf.event_location_title ? post.acf.event_location_title  : null ) }</p>
						}
						
						{
							// Street Address
							<p>{ (displayAddress && post.acf.event_street ? post.acf.event_street : null ) }</p>
						}
						
						{
							// City, State, Zip
							( displayAddress && post.acf.event_citypost &&  post.acf.event_zip && post.acf.event_state ? <p>{ post.acf.event_citypost+", "+post.acf.event_zip+", "+post.acf.event_state }</p> : null )
						}
			
						{
							// Google Maps
							displayMapLink && post.acf.event_map_link !== undefined && post.acf.event_map_link ? (
								<a href={ post.acf.event_map_link } title="View on Google Maps">{"Get Directions"}</a>					
							) : (
								null
							)
						}
						
						</li>
					) }
				</ul>
			</Fragment>
		);
	}
}

export default withSelect( ( select, props ) => {
	const { postsToShow, order, orderBy, categories } = props.attributes;
	const { getEntityRecords } = select( 'core' );
	
	const eventPostsQuery = pickBy( {
		hmseventtypes: categories, // Changes rest base to hms_event_types taxonomy and selects term by Id
		order,
		orderby: orderBy,
		query: true,
		per_page: postsToShow,
	},

	( value ) => ! isUndefined( value ) );
	const eventTypesListQuery = {
		per_page: 100,
		showPostsCount: true,
	}

	return {
		// Enables post type on displayed posts.		
		latestPosts: getEntityRecords( 'postType', 'hmsevents', eventPostsQuery ),
		// Adds hms_event_types dropdown selector list.
		categoriesList: getEntityRecords( 'taxonomy','hmseventtypes', eventTypesListQuery ),
	}

	

} )( EventsPostsFeedEdit );
