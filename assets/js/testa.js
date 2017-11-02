/* target shiftKey, keyCode, altKey
 * 
 * Default shortcuts, Ctrl + letter:

	Letter	Action
	* u		Underline
	* b		Bold
	* i		Italic
	* x		Cut
	* c		Copy
	* v		Paste
	* a		Select all
	* z		Undo
	* y		Redo


 * Additional shortcuts, Shift + Alt + letter:

	Letter	Action
	* 1		Heading 1
	* 2		Heading 2	
	* 3		Heading 3
	* 4		Heading 4	
	* 5		Heading 5
	* 6		Heading 6
	* q		Blockquote	
	* d		Strikethrough
	* c		Align center
	* r		Align right
	* l		Align left
	* j		Justify
	* u		Bulleted list
	* o		Numbered list
 */

(function (w, d, $) {
	"use strict";

	//main object 
	function H(el) {

		//Special keys
		this.keys = {
			'enter': 13,

			//Headings
			'1': 49,
			'2': 50,
			'3': 51,
			'4': 52,
			'5': 53,
			'6': 54,

			//CTRL controls			
			b: 66,
			i: 73,
			u: 85,
			y: 89,
			z: 90,

			//Alt + shift commands
			c: 67,
			d: 68,
			j: 74,
			l: 76,
			o: 79,
			q: 81,
			r: 82,

			//Misc			
			k: 75,
			p: 80,
			s: 83,
			x: 88,

		}

		//Wraps the editor 
		this.wrapper = $('<div>').addClass('Medium-wrapper')

		//The attached element
		this.el = el

			//Enable content editable
			.prop('contentEditable', 'true')

			//Spellchecking
			.attr('spellcheck', 'true')

			//Wrap the element with our main div
			.wrap(this.wrapper)

			//Default class 
			.addClass('Medium')

		//Footer bar
		this.footerBar = $('<div>').addClass('Medium-footer').hide().insertAfter(el)

		//Toolbar
		this.toolBar = $('<div>').addClass('Medium-tools').hide().insertBefore(el)

		//Placeholders		
		this.placeholder = $('<div>').addClass('Medium-placeholder').hide().insertBefore(el)

	}

	//I hate typing
	var prot = H.prototype

	//Init the whole stuff
	prot.init = function (options) {

		//Instance options
		this.options = $.extend({

			placeholder: "Write here...",
			paragraph: "p",

			//Applied to element
			classes: {},

			//Display word counts
			wordCount: true,

			//Callback to update or render the footer bar
			updateFooterBar: this.updateFooterBar,

			//Callback that renders or updates the toolbar.
			renderToolbar: this.renderToolbar,

			//Tools; what tools to display on the toolbar and in what order
			tools: {
				'select': {
					formatBlock: {
						p: 'Paragraph',
						h1: 'H1',
						h2: 'H2',
						h3: 'H3',
						h4: 'H4',
						h5: 'H5',
						h6: 'H6',
						pre: 'Preformatted',
					},
				},

				'buttons': {
					//Command : args
					bold: {
						label: 'Bold',
						html: this.getSVGHTML('M13.5 15.516c0.844 0 1.5-0.656 1.5-1.5s-0.656-1.5-1.5-1.5h-3.516v3h3.516zM9.984 6.516v3h3c0.844 0 1.5-0.656 1.5-1.5s-0.656-1.5-1.5-1.5h-3zM15.609 10.781c1.313 0.609 2.156 1.922 2.156 3.422 0 2.109-1.594 3.797-3.703 3.797h-7.078v-14.016h6.281c2.25 0 3.984 1.781 3.984 4.031 0 1.031-0.656 2.109-1.641 2.766z'),
					},

					italic: {
						label: 'Italic',
						html: this.getSVGHTML('M9.984 3.984h8.016v3h-2.813l-3.375 8.016h2.203v3h-8.016v-3h2.813l3.375-8.016h-2.203v-3z'),
					},

					insertUnorderedList: {
						label: 'Unordered list',
						html: this.getSVGHTML('M6.984 5.016h14.016v1.969h-14.016v-1.969zM6.984 12.984v-1.969h14.016v1.969h-14.016zM6.984 18.984v-1.969h14.016v1.969h-14.016zM3.984 16.5c0.844 0 1.5 0.703 1.5 1.5s-0.703 1.5-1.5 1.5-1.5-0.703-1.5-1.5 0.656-1.5 1.5-1.5zM3.984 4.5c0.844 0 1.5 0.656 1.5 1.5s-0.656 1.5-1.5 1.5-1.5-0.656-1.5-1.5 0.656-1.5 1.5-1.5zM3.984 10.5c0.844 0 1.5 0.656 1.5 1.5s-0.656 1.5-1.5 1.5-1.5-0.656-1.5-1.5 0.656-1.5 1.5-1.5z'),
					},

					insertOrderedList: {
						label: 'Ordered list',
						html: this.getSVGHTML('M6.984 12.984v-1.969h14.016v1.969h-14.016zM6.984 18.984v-1.969h14.016v1.969h-14.016zM6.984 5.016h14.016v1.969h-14.016v-1.969zM2.016 11.016v-1.031h3v0.938l-1.828 2.063h1.828v1.031h-3v-0.938l1.781-2.063h-1.781zM3 8.016v-3h-0.984v-1.031h1.969v4.031h-0.984zM2.016 17.016v-1.031h3v4.031h-3v-1.031h1.969v-0.469h-0.984v-1.031h0.984v-0.469h-1.969z'),
					},

					blockquote: {
						label: 'Blockquote list',
						html: this.getSVGHTML('M14.016 17.016l1.969-4.031h-3v-6h6v6l-1.969 4.031h-3zM6 17.016l2.016-4.031h-3v-6h6v6l-2.016 4.031h-3z'),
						//Tell heditor to call this function instead of autogenerating one 
						cb: function (e) {
							this.doCommand('formatBlock', 'blockquote')
						}
					},

					justifyLeft: {
						label: 'Align left',
						html: this.getSVGHTML('M3 3h18v2.016h-18v-2.016zM3 21v-2.016h18v2.016h-18zM3 12.984v-1.969h18v1.969h-18zM15 6.984v2.016h-12v-2.016h12zM15 15v2.016h-12v-2.016h12z'),
					},

					justifyCenter: {
						label: 'Align center',
						html: this.getSVGHTML('M3 3h18v2.016h-18v-2.016zM6.984 6.984h10.031v2.016h-10.031v-2.016zM3 12.984v-1.969h18v1.969h-18zM3 21v-2.016h18v2.016h-18zM6.984 15h10.031v2.016h-10.031v-2.016z'),
					},

					justifyRight: {
						label: 'Align right',
						html: this.getSVGHTML('M3 3h18v2.016h-18v-2.016zM9 9v-2.016h12v2.016h-12zM3 12.984v-1.969h18v1.969h-18zM9 17.016v-2.016h12v2.016h-12zM3 21v-2.016h18v2.016h-18z'),
					},

					justifyFull: {
						label: 'Justify',
						html: this.getSVGHTML('M3 3h18v2.016h-18v-2.016zM3 9v-2.016h18v2.016h-18zM3 12.984v-1.969h18v1.969h-18zM3 17.016v-2.016h18v2.016h-18zM3 21v-2.016h18v2.016h-18z'),
					},

					strikeThrough: {
						label: 'Strike through',
						html: 'S',
					},

					insertHorizontalRule: {
						label: 'Hr',
						html: '-',
					},
				}
			},
			//Keyboard commands
			ctrlCommands: {
				66: 'bold',
				85: 'underline',
				73: 'italic',
				89: 'redo',
				90: 'undo',
			},

			altShiftCommands: {
				//Objects mean format block
				49: {
					value: 'h1'
				},
				50: {
					value: 'h2'
				},
				51: {
					value: 'h3'
				},
				52: {
					value: 'h4'
				},
				53: {
					value: 'h5'
				},
				54: {
					value: 'h6'
				},
				81: {
					value: 'blockquote'
				},
				68: {
					value: 'strikeThrough'
				},
				//Strings mean do command
				85: 'insertUnorderedList',
				79: 'insertOrderedList',
				67: 'justifyCenter',
				82: 'justifyRight',
				76: 'justifyLeft',
				74: 'justifyFull',
			}

		}, options);

		//Allow overiding default settings with data attributes
		$.each(this.el.data(), function (key, value) {
			if (key.toLowerCase.startsWith('hedit')) {
				this.options[key.toLowerCase.substring(5)] = value
			}
		})

		//Clear previously attached event listners
		this.el.off('.heditor')

		var classes = this.options.classes || {}

		//Editor classes 
		if (classes.wrapper) {
			this.wrapper
				.removeClass('Medium-wrapper')
				.addClass(classes.wrapper)
		}

		if (classes.editor) {
			this.el
				.removeClass('Medium')
				.addClass(classes.editor)
		}

		if (classes.placeholder) {
			this.placeholder
				.removeClass('Medium-placeholder')
				.addClass(classes.placeholder)
		}

		if (classes.toolbar) {
			this.toolBar
				.removeClass('Medium-tools')
				.addClass(classes.toolbar)
		}

		if (classes.footerBar) {
			this.footerBar
				.removeClass('Medium-footer')
				.addClass(classes.footerBar)
		}

		//Placeholder text 
		if (this.options.placeholder) {
			this.placeholder.text(this.options.placeholder)
		}
		this.placeholders()

		//Maybe render toolbar
		if ($.isFunction(this.options.renderToolbar)) {
			$.proxy(this.options.renderToolbar, this).call()
		}

		var wasFocused = this.el.is(':focus')
		this.el.focus()

		//Paragraphs
		this.doCommand('DefaultParagraphSeparator', this.options.paragraph);

		//Make objects resizable
		this.doCommand('enableObjectResizing', true);

		//Inline table editing too
		this.doCommand('enableInlineTableEditing', true);

		if (!wasFocused) {
			this.el.blur()
		}

		//Setup events
		this.setEvents()
	}

	//Displays placeholder
	prot.placeholders = function () {
		this.placeholder.hide()

		//Abort if element has content...
		if (this.el.text().length) {
			return;
		}

		//... or is focused
		if (this.el.is(':focus')) {
			return true;
		}

		this.el.html('<p><br></p>')
		this.placeholder.show()
	}

	//Excecutes a command
	prot.doCommand = function (command, arg) {
		if (arg) {
			return document.execCommand(command, false, arg)
		} else {
			return document.execCommand(command, false)
		}
	}

	//Selection engine
	prot.selection = {
		saveSelection: function () {
			if (w.getSelection) {
				//IE 9+ and Others
				var sel = w.getSelection();
				if (sel.rangeCount) {
					return sel.getRangeAt(0);
				}
			} else if (d.selection && d.selection.createRange) { // IE 8-
				return d.selection.createRange();
			}
			return null;
		},

		restoreSelection: function (range) {
			if (range) {
				if (w.getSelection) {
					var sel = w.getSelection();
					sel.removeAllRanges();
					sel.addRange(range);
				} else if (d.selection && range.select) { // IE
					range.select();
				}
			}
		}
	}

	//Setup events
	prot.setEvents = function () {

		this.el
			//On focus; restore the previous selection and hide the placeholder
			.on(
				'focus.heditor',
				$.proxy(function () {

					if (this.curSelection) {
						this.selection.restoreSelection(this.curSelection)
					}
					this.placeholder.hide()
					return true

				}, this)
			)

			//On blur, maybe display the placeholder
			.on(
				'blur.heditor',
				$.proxy(function (e) {
					this.placeholders()
					return true
				}, this)
			)

			//Watch for special keypresses
			.on(
				'keydown.heditor',
				$.proxy(function (e) {

					//Only handle special events
					if (!this.isSpecial(e)) {
						return true;
					}

					//No need to repeat ourself here
					if (this.isCtrl(e) && this.options.ctrlCommands[e.which]) {
						this.doCommand(this.options.ctrlCommands[e.which])
						return false
					}

					if (this.isAltShift(e) && this.options.altShiftCommands[e.which]) {

						var cmd = this.options.altShiftCommands[e.which]
						if ($.isPlainObject(cmd)) {
							this.doCommand('formatBlock', cmd.value)
							return false
						}
						this.doCommand(cmd)
						return false

					}

					return true;

				}, this)
			)

	}

	//Is this ctrl
	prot.isCtrl = function (e) {
		return (e.ctrlKey || e.metaKey) && !e.altKey && !e.shiftKey
	}

	//Is this alt + shift
	prot.isAltShift = function (e) {
		return e.altKey && e.shiftKey && !e.ctrlKey && !e.metaKey
	}

	//Is this a special keypress
	prot.isSpecial = function (e) {
		return e.altKey || e.shiftKey || e.ctrlKey || e.metaKey
	}

	//Generates svg button html
	prot.getSVGHTML = function (path) {

		if (!path) {
			return ''
		}

		//SVG is not HTML, so methods such as html() wont work here
		return $(
				'<svg' +
				' xmlns="http://www.w3.org/2000/svg"' +
				' width="24px" height="24px"' +
				' viewBox="0 0 24 24">' +
				' <path d="' + path + '"/></svg>'
			)
			.css({
				display: 'inline-block',
				width: '1em',
				height: '1em',
				strokeWidth: '0',
				stroke: 'currentColor',
				fill: 'currentColor',
				fontSize: '20px',
			})

	}

	//Renders the toolBar
	prot.renderToolbar = function () {

		//Abort if no tools are set
		if ($.type(this.options.tools) !== "object") {
			return;
		}

		//Display the toolbar
		this.toolBar
			.show()
			.css({
				position: 'relative',
				top: '0',
				width: '100%',
				marginTop: '10px',
				marginBottom: '0',
				textAlign: 'left',
			})
			.attr('role', 'group')
			.attr('hidefocus', '1')

		//Select boxes
		var _select = this.options.tools.select || {}
		$.each(_select, $.proxy(function (command, options) {

			var $select = $('<select>')
				.css({
					maxWidth: '160px',
					border: '1px solid rgba(51, 51, 51, 0.5)',
					padding: '1px 5px',
					marginBottom: '3px',
				})

				//Save the current selection on mouse click
				.on('mousedown.heditor', $.proxy(function () {
					this.curSelection = this.selection.saveSelection()
					return true
				}, this))

				//Excecute the specified command
				.on('change.heditor mousedown.heditor', $.proxy(function (e) {
					this.el.focus()
					this.doCommand(command, $(e.target).val())
				}, this))

				//Finally add it to the toolbar
				.appendTo(this.toolBar)

			$.each(options, function (val, label) {
				$('<option>').attr('value', val).html(label).appendTo($select)
			})
		}, this))

		//Toolbar buttons
		var buttons = this.options.tools.buttons || {}
		$.each(buttons, $.proxy(function (command, value) {
			$('<span>')
				.css({
					transition: '.2s ease-out',
					cursor: 'pointer',
					display: 'inline-block',
					backgroundColor: 'transparent',
					color: '#333',
					padding: '2px 3px',
					marginRight: '10px',
					width: '20px',
					height: '20px',
					lineHeight: '20px',
				})
				.attr('aria-label', value.label)
				.attr('tabindex', '-1')

				//Save the current selection before its lost
				.on('mousedown.heditor', $.proxy(function () {
					this.curSelection = this.selection.saveSelection()
					return true;
				}, this))

				//Excecute the specified command
				.on('click.heditor', $.proxy(function (e) {
					this.el.focus()

					//Maybe display extra fields
					if (value.opt) {
						//Display extra fields 
						return false
					}

					//If a custom cb is provided
					if (value.cb) {
						$.proxy(value.cb, this, e).call()
						return false
					}
					this.doCommand(command)

				}, this))
				.append(value.html)
				.appendTo(this.toolBar)

		}, this))

		this.placeholder.css({
			'top': this.toolBar.height()
		})

	}

	//Fetch content as html
	prot.getHTML = function () {
		return this.el.html()
	}

	//Fetch content as text
	prot.getText = function () {
		return this.el.text()
	}

	//Word count
	prot.wordCount = function () {
		var words = this.el.text()
		if (!words.length) {
			return 0
		}
		return words.split(/\s/).length
	}

	// Add the hedit function to the top level of the jQuery object
	$.heditor = function (el, options) {
		var el = $(el)

		//Dont init the editor twice on the same element
		if (!el._heditor) {
			el._heditor = new H(el)
		}
		el._heditor.init(options)
		return el;
	};

	//Current version
	$.heditor.version = "1.0.0";

	// Also add the hedit function as a chainable property
	$.fn.heditor = function (options) {
		return this.each(function () {
			$.heditor(this, options);
		});
	};

})(window, document, jQuery);