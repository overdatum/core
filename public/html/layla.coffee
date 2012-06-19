# This script manages the state, animations, UI and domain interaction for the Admin component

# API Methods

# GET		/pages
# GET		/page/(:num)
# GET		/page/(:num)
# POST		/page
# PUT		/page/(:num)
# DELETE	/page/(:num)

# GET		/accounts
# GET		/account/(:num)
# POST		/account
# PUT		/account/(:num)
# DELETE	/account/(:num)


# GET		/modules

# GET		/mediagroups

# GET		/media/

# manage/media/1/group/2/media/423

# GET 		/media/1/group/2/media/12


- Home
	- Notifications
	- Launch
		Add - Page
		Add - Media
		Add - Account
		Add - Layout
	- Activity
	- Profile
- Pages
	- Filter
		- Languages
	- Columns
		Thumbnail (for now, immediatenet.com, later, host one ourselves- )
		- Menu
		- URL
		- Homepage
		- Languages
	- Detail
		- Form
			- Fields
				- Menu
				- URL
		- Sidebar
			- Versions
			- Activity
- Media
	- Columns
		Module Name [Layla, Webshop, Blog, etc- .]
		- Albums
			- Thumbnails
	- Detail
		- Columns
			Group Name [Product Images, Category Images, Invoice, Icons etc- <-- mediagroups
			Thumbnails
			Crop-sizes
		- Detail
			- Filter
				- Images
				- Videos
				- Other
			- Columns
				Media
			- Detail
				- Form
					- Images
						- Fields
							Name- ,
							Crop - settings
								- types
								- sizes
						- Upload (+ drop area- )
					- Videos
						- Fields
							Name
							Dimensions
							URL
					- Other
						- Name
						- Description
						- Download enabled

- Accounts
	- Columns
		- Name
		- Email
		- Roles
		- Language
	- Detail
		- Form
			- Fields
				- Name
				- Email
				- Roles
				- Language
		- Sidebar
			- Versions
			- Activity
- Settings
	- Form
		- Fields
			Website - Name
			Database - Settings
			Caching - Settings
			- Themeing
			etc- .
	- Sidebar
		- Versions
		- Activity
- Profile
	- Form
		- Fields
			- Name
			- Bio
			- Email
			- Language
			- Gravatar

- Modules
	- Column
		- Module name
		- Author
		- Description
	- Detail
		- Form / Sub
	- Install
		- Columns
			- Module Name
		- Tabs
			- Local
			- Remote
	- Create Form
		- ...

# Create a root object
root = exports ? this

# Print debug messages
root.debug = true

# ## Layla
class Layla

	# Setting defaults
	constructor: ->
		@pages =
			accounts: new AccountsPage
			pages: new PagesPage

	# Get a page instance
	getPage: (page) ->
		@pages[page]

	# Get the active page instance
	getActivePage: ->
		@pages[@activePage]
	
	# Get the animation to go to a page
	toPage: (page) ->
		@getPage(page).toPage()

	# Animate to a page and view and load any dependencies if needed on our way
	to: (page, view) ->
		# Looks like we are "routing" for the first time
		if ! @activePage
			@activePage = page
			toPageCallback = @toPage page
			toPageCallback ->

		# Load the animation to take us to the view that we need, starting at the (new) page we are going to
		toViewCallback = @pages[page].toView
			view: view
		
		# Provide a "fake" callback in case the page is already at the correct view
		if ! toViewCallback
			toViewCallback = (callback) ->
				callback() if callback

		# We are going to a different page
		if page != @activePage
			# Get the first view in the views stack of the current page
			homeView = @getActivePage().getHomeView()

			# Get the animation to the first view
			toHomeViewCallback = @getActivePage().toView
				view: homeView
				immediately: true

			# Provide a "fake" callback in case the current page is already at the first view
			if ! toHomeViewCallback
				toHomeViewCallback = (callback) ->
					callback() if callback

			# Set the new active page, this happends before the new page is loaded to ignore
			# clicks (to the same view, for another Account for example) while animating
			@activePage = page

			# Get the animation to the new page
			toPageCallback = @toPage(page)

			# Load all stuff that we need on our new page and animate to the view we want to go to when done
			toHomeViewCallback ->
				toPageCallback ->
					toViewCallback ->
		else
			# Animation to get to the view
			toViewCallback ->
		return

# ## LaylaPage
class LaylaPage extends Backbone.View
	# Get the first view for a page
	getHomeView: ->
		@viewsToMap(@views)[0]

	# Get a view for this page
	getView: (view) ->
		@views[view]

	# Return the keys for all views (had troubles with _.keys())
	viewsToMap: (views) ->
		(view for view of views)

	# Animate from the active view of this page to another
	toView: (options) ->
		callback = @views[@activeView].toView options

		@activeView = options.view
		
		callback

# ## LaylaView
# Nothing to see here (yet?)
class LaylaView


# # Pages

# ## Model

class PageModel extends Backbone.Model
	url: ->
		'/v1/page/' + @id if @id else '/v1/page'

# ## Collection
class PagesCollection extends Backbone.Collection
	model: PageModel

	url: '/v1/page/all'

	parse: (response) ->
		response.results

# ## Views

# #### PagesListView
# Animations for animating from the "list" view to the "form" and "onsite" views
class PagesListView extends LaylaView

	el: '#pages .list-column .items'

	isLoaded: false

	renderItem: (page) ->
		@item.render(page)

	render: (collection) ->
		$(@views.list.el).html ''
		@views.list.appendItem model for model in collection.models
		@views.list.isLoaded = true

	appendItem: (model) ->
		pagesListItemView = new PagesListItemView
			model: model

		$(@el).append pagesListItemView.render(model)

	toView: (options) ->
		
		view = options.view
		immediately = options.immediately

		switch view
			when 'form'
				# PagesList is going to animate to PageForm
				console.log 'PagesList is going to animate to PageForm' if root.debug
				(callback) ->
					if immediately
						$('#pages .form-column .container').css
							marginLeft: 0
		
						$('#pages .list-column .container').css
							marginLeft: '-300px'

						$('#pages .list-column').css
							width: 0

						$('#pages .form-column').css
							right: 300

						$('#pages .versions-column .container').css
							marginLeft: 0

						callback()
					else
						$('#pages .form-column .container').animate
							marginLeft: 0
						, 600

						$('#pages .list-column .container').animate
							marginLeft: '-300px'
						, 600

						$('#pages .list-column').animate
							width: 0
						, 600

						$('#pages .form-column').animate
							right: 300
						, 600

						$('#pages .versions-column .container').animate
							marginLeft: 0
						, 600

						setTimeout callback, 600
			when 'onsite'
				console.log 'PagesList is going to animate to PageOnsite' if root.debug
				(callback) ->
					if immediately
						callback()
					else
						setTimeout callback, 600

# #### PageFormView
# Animations for animating from the "form" view to the "list" or "onsite" views
class PageFormView extends LaylaView
	toView: (options) ->
		
		view = options.view
		immediately = options.immediately

		switch view
			when 'list'
				# PageForm is going to animate to PagesList
				console.log 'PageForm is going to animate to PagesList'  if root.debug
				(callback) ->
					if immediately
						$('#pages .form-column .container').css
							marginLeft: '100%'

						$('#pages .list-column .container').css
							marginLeft: 0

						$('#pages .list-column').css
							width: '100%'

						$('#pages .form-column').css
							right: 0

						$('#pages .versions-column .container').css
							marginLeft: '100%'

						callback()
					else
						$('#pages .form-column .container').animate
							marginLeft: '100%'
						, 600

						$('#pages .list-column .container').animate
							marginLeft: 0
						, 600

						$('#pages .list-column').animate
							width: '100%'
						, 600

						$('#pages .form-column').animate
							right: 0
						, 600

						$('#pages .versions-column .container').animate
							marginLeft: '100%'
						, 600

						setTimeout callback, 600
			when 'onsite'
				# PageForm is going to animate to PageOnsite
				console.log 'PageForm is going to animate to PageOnsite' if root.debug
				(callback) ->
					if immediately
						callback()
					else
						setTimeout callback, 600

# #### PageFormView
# Animations for animating from the "onsite" view to the "list" or "form" views
class PageOnsiteView extends LaylaView
	toView: (options) ->
		
		view = options.view
		immediately = options.immediately

		switch view
			when 'list'
				# PageOnsite is going to animate to PagesList
				console.log 'PageOnsite is going to animate to PagesList' if root.debug
				(callback) ->
					if immediately
						callback()
					else
						setTimeout callback, 600
			when 'form'
				# PageOnsite is going to animate to PageForm
				console.log 'PageOnsite is going to animate to PageForm' if root.debug
				(callback) ->
					if immediately
						callback()
					else
						setTimeout callback, 600

# ## Page

# ### PagesPage
# Animation for animating to a view on the **PAGES** page from another page and setting up the views
class PagesPage extends LaylaPage
	# The collection associated with this page
	collection: new PagesCollection

	# Where it all begins...
	activeView: 'list'

	# Setting the views that this page holds
	views:
		list: new PagesListView,
		form: new PageFormView,
		onsite: new PageOnsiteView

	toPage: ->
		# Start fetching right away
		if ! @views.list.isLoaded
			@collection.fetch()

		(callback) ->
			$('#content > div').hide()
			$('#pages').fadeIn 600
			setTimeout callback, 600


class AccountModel extends Backbone.Model
	url: ->
		if ! @isNew()
			'/v1/account/' + @id
		else
			'/v1/account'

	findByVersion: (options) ->
		@success = options.success
		@error = options.error
		@first = options.first

		@fetch
			success: @success
			error: @error

class AccountsCollection extends Backbone.Collection
	model: AccountModel

	# data:
	# 	$.param
	# 		search:
	# 			columns: ['email']
	# 		string: 'voetdermit'

	url: '/v1/account/all'

	parse: (response) ->
		response.results

# # Accounts

# ## Views

class AccountsListItemView extends Backbone.View

	tagName: 'li'

	initialize: ->
		@template = _.template $('#account-list-item-template').html()
		@model.bind 'change', @render, @
		@model.bind 'destroy', @remove, @

	render: ->
		@$el.html(@template(@model.toJSON()))

	unrender: ->
		@$el.remove()

	remove: ->
		@model.destroy()


# #### AccountsListView
# Animations for animating from the "list" view to the "form"
class AccountsListView extends LaylaView

	el: '#accounts .list-column .items'

	isLoaded: false

	renderItem: (account) ->
		@item.render account

	render: (collection) ->
		$(@views.list.el).html ''
		@views.list.appendItem model for model in collection.models
		@views.list.isLoaded = true

	appendItem: (model) ->
		accountsListItemView = new AccountsListItemView
			model: model
		$(@el).append accountsListItemView.render()

	toView: (options) ->
		
		view = options.view
		immediately = options.immediately

		switch view
			when 'form'
				# AccountsList is going to animate to AccountForm
				console.log 'AccountsList is going to animate to AccountForm' if root.debug
				(callback) ->
					if immediately
						$('#accounts .form-column .container').css
							marginLeft: 0

						$('#accounts .list-column .container').css
							marginLeft: '-300px'

						$('#accounts .list-column').css
							width: 0

						$('#accounts .form-column').css
							right: 300

						$('#accounts .versions-column .container').css
							marginLeft: 0

						callback()
					else
						$('#accounts .form-column .container').animate
							marginLeft: 0
						, 600

						$('#accounts .list-column .container').animate
							marginLeft: '-300px'
						, 600

						$('#accounts .list-column').animate
							width: 0
						, 600

						$('#accounts .form-column').animate
							right: 300
						, 600

						$('#accounts .versions-column .container').animate
							marginLeft: 0
						, 600

						setTimeout callback, 600

# #### AccountFormView
# Animations for animating from the "form" view to the "list"
class AccountFormView extends LaylaView

	el: '#accounts .form-column .container'

	makeModel: (id) ->
		new AccountModel
			id: id

	load: (options) ->
		@id = options.id
		@version = options.version

		@makeModel(@id).findByVersion
			version: @version
			success: (data) ->
				console.log data

	render: (model) ->
		alert 'redering'
		$(@el).html model.toJSON()

	toView: (options) ->
		
		view = options.view
		immediately = options.immediately

		switch view
			when 'list'
				# AccountForm is going to animate to AccountsList
				console.log 'AccountForm is going to animate to AccountsList' if root.debug
				(callback) ->
					if immediately
						$('#accounts .form-column .container').css
							marginLeft: '100%'

						$('#accounts .list-column .container').css
							marginLeft: 0

						$('#accounts .list-column').css
							width: '100%'

						$('#accounts .form-column').css
							right: 0

						$('#accounts .versions-column .container').css
							marginLeft: '100%'

						callback()
					else
						$('#accounts .form-column .container').animate
							marginLeft: '100%'
						, 600

						$('#accounts .list-column .container').animate
							marginLeft: 0
						, 600

						$('#accounts .list-column').animate
							width: '100%'
						, 600

						$('#accounts .form-column').animate
							right: 0
						, 600

						$('#accounts .versions-column .container').animate
							marginLeft: '100%'
						, 600

						setTimeout callback, 600


# #### AccountsPage
# Animations for animating to a view on the **ACOUNTS** page from another page and setting up the views
class AccountsPage extends LaylaPage

	constructor: ->
		@collection.on 'refresh', @views.list.render, @
		@collection.on 'reset', @views.list.render, @

	# The collection associated with this page
	collection: new AccountsCollection

	# Where it all begins...
	activeView: 'list'

	# Setting the views that this page holds
	views:
		list: new AccountsListView
		form: new AccountFormView

	toPage: ->
		# Start fetching right away
		if ! @views.list.isLoaded
			@collection.fetch()

		(callback) ->
			$('#content > div').hide()
			$('#accounts').fadeIn 600
			setTimeout callback, 600

layla = new Layla

# ## Router
class AccountController extends Backbone.Router

	routes:
		"accounts": "index"
		"accounts/:view": "index"
		"account/add": "add"
		"account/:id": "edit"
		"account/:id/version/:version": "edit"

	index: (view = 'list') ->
		console.log "to: accounts/" + view if root.debug
		layla.to('accounts', view)

	edit: (id, version) ->
		layla.getPage('accounts').getView('form').load
			id: id
			version: version
		
		if version
			console.log "to: account/" + id + "/version/" + version if root.debug
		else
			console.log "to: account/" + id if root.debug
			layla.to('accounts', 'form')

class PageController extends Backbone.Router

	routes:
		"pages": "index"
		"pages/:view": "index"
		"pages/add": "add"
		"page/:id": "edit"
		"page/:id/version/:version": "edit"

	index: (view = 'list') ->
		console.log "to: pages/" + view if root.debug
		layla.to('pages', view)

	edit: (id, version) ->
		if version
			console.log "to: page/" + id + "/version/" + version if root.debug
		else
			console.log "to: page/" + id if root.debug
			layla.to('pages', 'form')

class App

	constructor: ->
		@controllers =
			accounts: new AccountController,
			pages: new PageController

	start: ->
		# Let's write history
		Backbone.history.start()
			#pushState: true

# Wait for the DOM to be ready
$(document).ready ->
	app = new App
	app.start()