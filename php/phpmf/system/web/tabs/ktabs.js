/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

if(!KWidget) var KWidget = { };

KWidget.KTab = Class.create({
    initialize: function()
    {
        $A($$('div.kTabContainer li.kTabFlap a')).each(function(element){
            element.observe('click', function(event){
                var element = event.element();
                var container = element.up('.kTabContainer').id;
                var flap = element.up('.kTabFlap').id;
                var length = $A($$('#'+container+' li.kTabFlap')).length;
                for(var i = 0; i < length ; i++)
                    if($(container+'Flap'+i))
                        if(container+'Flap'+i == flap){
                            $(container+'Flap'+i).down('a').addClassName('active');
                            $(container+'Pane'+i).setStyle({
                                display: 'block'
                            });
                        }
                        else{
                            $(container+'Flap'+i).down('a').removeClassName('active');
                            $(container+'Pane'+i).setStyle({
                                display: 'none'
                            });
                        }
            });
        });
    }
});

window.onload = function(){
    KWidget.Tabs = new KWidget.KTab()
    };
