jQuery(function() {
	
	var ax_admin_panel_isChanged = false;
	
	jQuery.fn.nmp_tabs = function(checkFunc) {
		var t = jQuery(this);
		var ul = t.children('ul');
		var tabs = ul.eq(0).children('li');
		var panes = ul.eq(1).children('li');
		var initial;

		tabs.each(function(i) {
			var t = jQuery(this);
			if (t.hasClass('initial'))
				initial = t;
			t.click(function(e) {
				if ((checkFunc)())
				{
					tabs.removeClass('active');
					t.addClass('active');
					panes.hide();
					panes.eq(i).show();
				}
			});
		});

		if (!initial)
			initial = tabs.first();
		
		initial.trigger('click');
	}
	
	var ax_admin_panel_isChanged = false;
						
	jQuery('.nmp_admin_panel .tabs > li').bind('click.tmp', function(e) {
	});	
	
	jQuery('.nmp_tabpanel').each(function() {
		var t = jQuery(this);
		t.nmp_tabs(function() {
			if (!ax_admin_panel_isChanged)
				return true;
				
			if (!confirm('Your unsaved changes won\'t be saved. Continue?'))
				return false;

			jQuery('.nmp_admin_panel form').each(function() { jQuery(this).find('input[type=reset]').click() });
			ax_admin_panel_isChanged = false;
			return true;
		});
	});
	
	jQuery('.nmp_admin_panel form').change(function() {
		ax_admin_panel_isChanged = true;
	});

});