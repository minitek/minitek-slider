((document, Joomla) => {
    'use strict';
    
    class Mslider 
    {
        /*
        * Constructor
        */
        constructor(options, id, count, path) 
        {
            const self = this;
            this.options = options;
            this.widgetId = parseInt(id, 10);
            this.totalCount = parseInt(count, 10);
            this.path = path;	

            this.mediaSlider = (this.options.slider_theme == 'media_slider') ? true : false;
			this.hoverbox = parseInt(this.options.slider_hb, 10);
            
            // Initialize slider
            this.initializeSlider();
            
            // Progress bar
			if (parseInt(this.options.slider_progressbar, 10))
                this.initializeProgressBar();

            // Media slider
            if (this.mediaSlider)
                this.initializeMediaSlider();

            // Hover box
            if (this.hoverbox)	
            {
                this.triggerHoverBox();

                // Modal images
				if (parseInt(this.options.slider_hb_zoom, 10))
                    this.initModalMessages();
            }
        }

        initializeSlider()
        {
            const self = this;
            this.container = document.querySelector('#mslider_' + this.widgetId);
            
            this.draggable = parseInt(this.options.slider_drag, 10) ? '>1' : false;
            this.freeScroll = parseInt(this.options.slider_free_scroll, 10) ? true : false;
            var wrapAround = parseInt(this.options.slider_rewind, 10) ? true : false;
            var fullscreen = parseInt(this.options.slider_fullscreen, 10) ? true : false;
            var adaptiveHeight = parseInt(this.options.slider_adaptive_height, 10) ? true : false;
            this.dragThreshold = parseInt(this.options.slider_drag_threshold, 10) ? parseInt(this.options.slider_drag_threshold, 10) : 3;
            this.selectedAttraction = parseFloat(this.options.slider_selected_attraction) ? parseFloat(this.options.slider_selected_attraction) : 0.025;
            this.friction = parseFloat(this.options.slider_friction) ? parseFloat(this.options.slider_friction) : 0.28;
            this.freeScrollFriction = parseFloat(this.options.slider_free_scroll_friction) ? parseFloat(this.options.slider_free_scroll_friction) : 0.075;
            var cellAlign = this.options.slider_cell_align;
            var contain = parseInt(this.options.slider_contain, 10) ? true : false;
            this.rightToLeft = parseInt(this.options.slider_rtl, 10) ? true : false;
            var prevNextButtons = parseInt(this.options.slider_arrows, 10) ? true : false;
            var pageDots = parseInt(this.options.slider_bullets, 10) ? true : false;

            // Show slider
			this.container.style.display = 'block';

			// Initialize Flickity
			this.slider = new Flickity(this.container, {
				draggable: this.draggable,
				freeScroll: this.freeScroll,
				wrapAround: wrapAround,
				groupCells: false,
				autoPlay: false,
				pauseAutoPlayOnHover: false,
				fullscreen: fullscreen,
				fade: false,
				adaptiveHeight: adaptiveHeight,
				hash: false,
				dragThreshold: this.dragThreshold,
				selectedAttraction: this.selectedAttraction,
				friction: this.friction,
				freeScrollFriction: this.freeScrollFriction,
				imagesLoaded: true,
				lazyLoad: false,
				cellSelector: '.mslider-item',
				initialIndex: 0,
				accessibility: true,
				setGallerySize: true,
				resize: true,
				cellAlign: cellAlign,
				contain: contain,
				rightToLeft: this.rightToLeft,
				percentPosition: true,
				prevNextButtons: prevNextButtons,
				pageDots: pageDots,
				on: {
					ready: function() {
						document.querySelector('#mslider_wrapper_' + self.widgetId).classList.add('flickity-ready');
						self.fixHeights(false);
					},
					fullscreenChange: function(isFullscreen) {
                        if (isFullscreen)
                            self.fixHeights(true);
                        else 
                            self.fixHeights(false);
        
                        self.slider.resize();
                    }
			  	}
			});
        }

        fixHeights(fullscreen, index = false)
        {
            var sliderPaddingTop = parseInt(this.options.slider_cont_padding, 10);
			var sliderPaddingBottom = sliderPaddingTop;
            var sliderMarginBottom = 30;
            var mediaDbPaddingTop = 40;
            var maxMediaDb = 350;
            var bullets = this.container.querySelector('.flickity-page-dots');
            var progressbar = document.querySelector('#mslider_progressbar_' + this.widgetId);

            if (fullscreen)
            {		
                // Fix slider height
                var height = document.querySelector('#mslider_wrapper_' + this.widgetId).offsetHeight - sliderPaddingTop;
                var slider_height = 0;
                var media_db_height = 0;
                var viewport_height;
                
                if (this.mediaSlider)
                {
                    if (index !== false)
                    {
                        var detail_boxes = this.container.querySelectorAll('.mslider-media-db .mslider-detail-box');

                        if (detail_boxes)
                            media_db_height = detail_boxes[index].offsetHeight + mediaDbPaddingTop;
                    }
                    else 
                    {
                        if (this.container.querySelector('.mslider-media-db'))
                            media_db_height = this.container.querySelector('.mslider-media-db').offsetHeight + mediaDbPaddingTop;
                    }

                    media_db_height = (media_db_height > maxMediaDb) ? maxMediaDb : media_db_height;
                }

                if (!bullets && !progressbar)
                    height = height - sliderPaddingBottom;
                else
                {
                    if (bullets && !progressbar)
                        sliderMarginBottom = 2 * sliderMarginBottom;
                    else if (!bullets && progressbar)
                        sliderMarginBottom = 10;
                    else if (bullets && progressbar)
                        sliderMarginBottom = 2 * sliderMarginBottom;
                }

                // Update calculations
                sliderMarginBottom = (bullets || progressbar) ? sliderMarginBottom : 0;
                
                // Container
                slider_height = height - sliderMarginBottom;
                this.container.style.height = slider_height + 'px';

                // Viewport
                viewport_height = slider_height - media_db_height;
                this.container.querySelector('.flickity-viewport').style.maxHeight = viewport_height + 'px';

                // Images
                if (this.container.querySelectorAll('.mslider-photo-link img'))
                {
                    var max_height = this.container.querySelector('.flickity-viewport').offsetHeight;

                    this.container.querySelectorAll('.mslider-photo-link img').forEach(function(a)
                    {
                        a.style.maxHeight = max_height + 'px';
                    });
                }
            }
            else
            {
                // Main
                this.container.style.height = 'auto';

                // Viewport
                this.container.querySelector('.flickity-viewport').style.maxHeight = 'inherit';

                // Images
                if (this.container.querySelectorAll('.mslider-photo-link img'))
                {
                    this.container.querySelectorAll('.mslider-photo-link img').forEach(function(a)
                    {
                        a.style.maxHeight = 'inherit';
                    });
                }
            }
        }

        initializeProgressBar()
        {
            var progressBar = document.querySelector('#mslider_progressbar_' + this.widgetId);

            this.slider.on('scroll', function(progress) 
            {
                progress = Math.max(0, Math.min(1, progress));
                progressBar.style.width = progress * 100 + '%';
            });
        }

        initializeMediaSlider()
        {
            const self = this;
            var media_db = self.container.querySelector('.mslider-media-db');
            var viewport = self.container.querySelector('.flickity-viewport');
            self.insertAfter(media_db, viewport);

            media_db.querySelectorAll('.mslider-detail-box').forEach(function(element, index)
            {
                element.setAttribute('data-selectedindex', index);
            });

            media_db.querySelector('.mslider-detail-box[data-selectedindex="0"]').style.display = 'block';

            self.slider.on('select', function(index) 
            {
                media_db.querySelectorAll('.mslider-detail-box').forEach(function(a)
                {
                    a.style.display = 'none';
                });
                
                media_db.querySelector('.mslider-detail-box[data-selectedindex="'+ index +'"]').style.display = 'block';

                // Update heights in fullscreen
                if (self.slider.isFullscreen)
                    self.fixHeights(true, index);
            });
        }

        triggerHoverBox() 
        {
            const self = this;

            self.container.querySelectorAll('.mslider-item').forEach(function(a)
            {
                a.addEventListener('mouseenter', function(e)
                {
                    switch (self.options.slider_hb_effect)
                    {
                        case 'no': 
                            this.querySelector('.mslider-hover-box').classList.add('hoverShow');
                            break;
                        case '1': 
                            this.querySelector('.mslider-hover-box').classList.add('hoverFadeIn');
                            break;
                        case '2': 
                            this.classList.add('perspective');
                            this.querySelector('.mslider-item-outer-cont').classList.add('flip', 'flipY', 'hoverFlipY');
                            break;
                        case '3': 
                            this.classList.add('perspective');
                            this.querySelector('.mslider-item-outer-cont').classList.add('flip', 'flipX', 'hoverFlipX');
                            break;
                        case '4':
                            this.querySelector('.mslider-hover-box').classList.add('animated', 'slideInRight');
                            break;
                        case '5':
                            this.querySelector('.mslider-hover-box').classList.add('animated', 'slideInLeft');
                            break;
                        case '6': 
                            this.querySelector('.mslider-hover-box').classList.add('animated', 'slideInTop');
                            break;
                        case '7':
                            this.querySelector('.mslider-hover-box').classList.add('animated', 'slideInBottom');
                            break;
                        case '8':
                            this.querySelector('.mslider-hover-box').classList.add('animated', 'msliderzoomIn');
                            break;
                        default:
                            this.querySelector('.mslider-hover-box').classList.add('hoverFadeIn');
                            break;
                    }
                });
                
                a.addEventListener('mouseleave', function(e)
                {
                    switch (self.options.mas_hb_effect)
                    {
                        case 'no':
                            this.querySelector('.mslider-hover-box').classList.remove('hoverShow');
                            break;
                        case '1':
                            this.querySelector('.mslider-hover-box').classList.remove('hoverFadeIn');
                            break;
                        case '2':
                            this.querySelector('.mslider-item-outer-cont').classList.remove('hoverFlipY');
                            break;
                        case '3':
                            this.querySelector('.mslider-item-outer-cont').classList.remove('hoverFlipX');
                            break;
                        case '4':
                            this.querySelector('.mslider-hover-box').classList.remove('slideInRight');
                            break;
                        case '5':
                            this.querySelector('.mslider-hover-box').classList.remove('slideInLeft');
                            break;
                        case '6':
                            this.querySelector('.mslider-hover-box').classList.remove('slideInTop');
                            break;
                        case '7':
                            this.querySelector('.mslider-hover-box').classList.remove('slideInBottom');
                            break;
                        case '8':
                            this.querySelector('.mslider-hover-box').classList.remove('msliderzoomIn');
                            break;
                        default:
                            this.querySelector('.mslider-hover-box').classList.remove('hoverFadeIn');
                            break;
                    }
                });
            });
        }

        createSpinner(divIdentifier, color)
        {
            var spinner_options = {
                lines: 9,
                length: 4,
                width: 3,
                radius: 3,
                corners: 1,
                rotate: 0,
                direction: 1,
                color: color,
                speed: 1,
                trail: 52,
                shadow: false,
                hwaccel: false,
                className: 'spinner',
                zIndex: 2e9,
                top: '50%',
                left: '50%'
            };

            var target = document.querySelector(divIdentifier);

            if (target)
            {
                var spinner = new Spinner(spinner_options).spin();
                target.innerHTML = '';
                target.appendChild(spinner.el);
            }

            return;
        }

        insertAfter(newNode, referenceNode) 
        {
            referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
        }

        htmlToElement(htmlString) 
        {
            var div = document.createElement('div');
            div.innerHTML = htmlString.trim();
            
            return div.firstChild; 
        }

        htmlToElements(htmlString, selector) 
        {
            var div = document.createElement('div');
            div.innerHTML = htmlString.trim();
            
            return div.querySelectorAll(selector); 
        }

        initModalMessages()
        {
            var zoomSlider = document.querySelector('#zoomSlider_' + this.widgetId);

            if (!zoomSlider)
                return;

            zoomSlider.addEventListener('show.bs.modal', function(e)
            {
                // Button that triggered the modal
                var button = e.relatedTarget;

                // Extract info from data-* attributes
                var title = button.getAttribute('data-title');
                var image = button.getAttribute('data-src');

                // Update the title 
                zoomSlider.querySelector('.modal-title').textContent = title;

                // Update the image
                zoomSlider.querySelector('img').setAttribute('src', image);
            });
        }
    }

    window.Mslider = {
        initialise: (options, id, count, path) => new Mslider(options, id, count, path)
    };
    
})(document, Joomla);
