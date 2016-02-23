//For Reservations Overview
$(function(){
   //Ak nie je na prehlade rezervacii tak sa kod nevykona
    var elementExists = $("#table-overview-dates").length > 0;

    if(!elementExists)
    {
        return;
    }
	
	$('.overview-horizontal').data('top', $('.overview-horizontal').offset().top);

    $(window).scroll(function(e){
        //Imitacia fixovanej pozicie - Pomocou css by nefungoval overflow
        $('.overview-horizontal').css("top", Math.max(0, window.pageYOffset-$('.overview-horizontal').data('top')))
		var x = $('.overview-horizontal').data('top');
		var h = $('.overview-content-wrapper').height();
		var hx = 68; //$('.overview-horizontal').height(); na frontende sa to má o 10px menej, neviem prečo :)
		var h2 = $(window).height();
		var o = window.pageYOffset;
		var formula = h - (h2 + o - x) + hx;
		$('#overview-scroolbar').css('bottom', Math.max(0, Math.min(h, formula)));
    });
	
	$('#overview-scroolbar > div').css('width', $('.overview-content-wrapper table').width()+$('#overview-vertical').width());
	
	$("#overview-scroolbar").scroll(function () { 
        $(".overview-content-wrapper").scrollLeft($("#overview-scroolbar").scrollLeft());
		var offset = $('#overview-vertical').width();
        $('#overview-rooms-wrapper').css("left", (-($(this).scrollLeft())+offset)+'px');
    });

    //Zobrazenie tooltipov s bootstrap style
    $('button, a').tooltip();

    var rowIndex = 0;
    $("#table-overview-dates tr").each(function(){
        var row = $($("#talbe-overview-content").find('tr')[rowIndex]);
        row.css("height", $(this).height());
        rowIndex++;
    });

    var rowIndex = 0;
    $("#talbe-overview-content tr").each(function(){
        var row = $($("#table-overview-dates").find('tr')[rowIndex]);
        row.css("height", $(this).height());
        rowIndex++;
    }); 
	
	$(window).scroll();

    var overview = {
        
        dayLength: 720, //pocet minut od 08:00 - 20:00

        $activePopover: undefined, //element, na ktorom je aktivny popover

        init: function() {
            var self = this;
        
            //Vyfarbenie casu ked je obsadene
            $('div[data-blocks]').each(function(){
                self.createBlocks($(this), self.parseBlocks($(this)));
            });

            $(".booking-avaiable td, .booking-unavaiable td").each(function() {
                var $td = $(this);

                //Najviac 1 aktivny popover
                $td.click(self.hidePopover.bind(self, $td));

                $td.popover({
                    html: true,
                    content: self.generatePopoverContent($td)
                }); 
            });

        },

        hidePopover: function($element) {

            if(this.$activePopover !== undefined) {

                if(this.$activePopover == $element) {
                    return;
                }

                this.$activePopover.popover('hide');
            }
            
            this.$activePopover = $element;
        },

        parseBlocks: function($element) {
            var self = this;
            var arr = $element.attr('data-blocks').trim().split(',');
            delete arr[arr.length-1];

            var blocks = arr.map(function(item) {

                var block = item.trim().split(';');

                block[1] = (block[1] > self.dayLength)? self.dayLength : block[1];

                var widthInPercent = (block[1] - block[0]) / self.dayLength * 100;


                if(widthInPercent > 100) {
                    widthInPercent = 100;
                }

                return {
                    'width' : widthInPercent,
                    'start' : parseInt(block[0]),
                    'end'   : parseInt(block[1])
                }

            }).sort(function(a, b){
                return a.start - b.start
            });

            return blocks;
        },

        createBlocks: function($element, blocks) {
            var self = this;

            blocks.forEach(function(block, index) {

                var margin = 0;

                if(index == 0)
                {
                    if(block.start > 0)
                    {
                        margin = (block.start) / self.dayLength * 100;
                    }
                }

                if(blocks[index - 1])
                {
                    if(block.start > blocks[index - 1].end)
                    {
                        margin = (block.start - blocks[index - 1].end) / self.dayLength * 100;
                    }
                }

                $element.append('<div class="block-reserved" style="width: '+block.width+'%; margin-left: '+margin+'%;"></div>')
            });
        },

        //Zo stringu rezervacii vytvori pole
        parseReservations: function(string) {
            if(string == undefined) return [];
            var string = string.substring(0, string.length-1);
            return string.split(';');
        },

        generatePopoverContent: function($td) {
            var html = "";
            var reservations = this.parseReservations($td.attr('data-reservations'));
            var reservationLink = $td.attr('data-reservation-link');
            var reservationIsAvaiable = $td.parent().hasClass('booking-avaiable');

            reservations = reservations.filter(function(element) {
                return element.trim() !== '';
            });

            reservations.forEach(function(reservation) {
                html += '<div>' + reservation + '</div>';
            });

            if(html == '') {
                html = '<div>Žiadne rezervácie</div>'
            }

            if(reservationIsAvaiable) {
                html += '</br><a href="' + reservationLink + '" class="btn btn-primary">Pridať</a>';
            }

            return html;
        }
    }
    $(document).ready(overview.init.bind(overview))
});