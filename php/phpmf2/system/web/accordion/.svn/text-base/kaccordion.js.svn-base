/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

if(!KWidget) var KWidget = { };

KWidget.KAccordion = Class.create({
    active: null,
    initialize: function()
    {
        this.active = $H();
        $A($$('ul.kAccordionContainer li.kAccordionFlap a')).each(function(element){
            element.observe('click', function(event){
                var element = event.element();
                var container = element.up('.kAccordionContainer').id;
                var flap = element.up('.kAccordionFlap').id;

                if(KWidget.Accordions.active.get(container) != flap)
                {
                    KWidget.Accordions.active.set(container, flap);
                    var length = $A($$('#'+container+' li.kAccordionFlap')).length;
                    var queue = Effect.Queues.get(container);
                    if(queue) queue.each(function(effect) {
                        effect.cancel();
                    });

                    for(var i = 0; i < length ; i++)
                    {
                        var cpane = container+'Pane'+i;
                        var cflap = container+'Flap'+i;
                        $(cpane).setStyle({
                            height: null
                        });
                        if($(cflap))
                            if(cflap == flap){
                                $(cflap).down('a').addClassName('active');
                                Effect.BlindDown($(cpane), {
                                    duration: 0.25,
                                    queue: {
                                        scope: container
                                    }
                                });
                            }
                            else{
                                $(cflap).down('a').removeClassName('active');
                                Effect.BlindUp($(cpane), {
                                    duration: 0.25,
                                    queue: {
                                        scope: container
                                    }
                                });
                            }
                    }
                }
            });
        });
    }
});

window.onload = function(){
    KWidget.Accordions = new KWidget.KAccordion();
};
