
    var sliderRangeFields = [{'field':'price','params':{'field':'price','min':25,'max':185000,'min_sel':25,'max_sel':185000,'step':10000,'measure_unit':'KES','class':'price-search-select'}},{'field':'floor','params':{'field':'floor','min':0,'max':30,'min_sel':0,'max_sel':30,'step':1,'class':'floor-search-select'}}];
    var cityField = {'minWidth':'290'};
    var loc = 0;
    var countFiled = 8;
    var isInner = 0;
    var heightField = 38;
    var advancedIsOpen = 0;
    var compact = 1;
    var minHeight = isInner ? 80 : 260;
    var searchCache = [];
    var objType = 0;
    var useSearchCache = false;

    var search = {
        init: function(){

            if(sliderRangeFields){
                $.each(sliderRangeFields, function() {
                    search.initSliderRange(this.params);
                });
            }

            if(cityField){
                $("#city")
                    .multiselect({
                        noneSelectedText: "Select a city/cities",
                        checkAllText: "Сheck all",
                        uncheckAllText: "Uncheck all",
                        selectedText: "# of # available",
                        minWidth: cityField.minWidth,
                        classes: "search-input-new search-city-height",
                        multiple: "false",
                        selectedList: 1
                    }).multiselectfilter({
                        label: "Quick search",
                        placeholder: "Enter initial letters",
                        width: 185
                    });
            }

            if(countFiled <= 6){
                if(advancedIsOpen){
                    if(isInner){
                        search.innerSetAdvanced();
                    }else{
                        search.indexSetNormal();
                        $('#more-options-link').hide();
                    }
                } else if(!isInner){
                    $('#more-options-link').hide();
                }
            } else {
                if(!isInner){
                    $('#more-options-link').show();
                }

                if(advancedIsOpen){
                    if(isInner){
                        search.innerSetAdvanced();
                    } else {
                        search.indexSetAdvanced();
                    }
                }
            }

        },

        initSliderRange: function(sliderParams){
            $( "#slider-range-"+sliderParams.field ).slider({
                range: true,
                min: sliderParams.min,
                max: sliderParams.max,
                values: [ sliderParams.min_sel , sliderParams.max_sel ],
                step: sliderParams.step,
                slide: function( e, ui ) {
                    $( "#"+sliderParams.field+"_min_val" ).html( ui.values[ 0 ] );
                    $( "#"+sliderParams.field+"_min" ).val( ui.values[ 0 ] );
                    $( "#"+sliderParams.field+"_max_val" ).html( ui.values[ 1 ] );
                    $( "#"+sliderParams.field+"_max" ).val( ui.values[ 1 ] );
                },
                stop: function(e, ui) {  changeSearch(); }
            });
        },

        indexSetNormal: function(){
            $("#homeintro").animate({"height" : "270"});
            $("div.index-header-form").animate({"height" : "234"});
            $("div.searchform-index").animate({"height" : "267"});
            $("#more-options-link").html("More options");
            advancedIsOpen = 0;
        },

        indexSetAdvanced: function(){
            var height = search.getHeight();
            $("#homeintro").animate({"height" : height + 10});
            $("div.index-header-form").animate({"height" : height});
            $("div.searchform-index").animate({"height" : height + 10});
            $("#more-options-link").html("Less options");
            advancedIsOpen = 1;
        },

        innerSetNormal: function(){
            $("#searchform-block").addClass("compact");
            $("#search-more-fields").hide();
            $("#more-options-link-inner").show();
            $("#more-options-img").hide();
            advancedIsOpen = 0;
        },

        innerSetAdvanced: function(){
            var height = search.getHeight();
            $("#searchform-block").removeClass("compact").animate({"height" : height + 20});
            $("#search_form").animate({"height" : height});
            $("#btnleft").removeClass("btnsrch-compact");
            $("#search-more-fields").show();
            $("#more-options-link-inner").hide();
            $("#more-options-img").show();
            advancedIsOpen = 1;
        },

        getHeight: function(){
            var height = countFiled * heightField + 30;

            if(height < minHeight){
                return minHeight;
            }

            return isInner ? height/2 + 20 : height;
        },

        renderForm: function(obj_type_id){
            $('#search_form').html(searchCache[obj_type_id].html);
            sliderRangeFields = searchCache[obj_type_id].sliderRangeFields;
            cityField = searchCache[obj_type_id].cityField;
            countFiled = searchCache[obj_type_id].countFiled + (loc ? 2 : 0);
            search.init();
            if(!useSearchCache){
                delete(searchCache[obj_type_id]);
            }
            changeSearch();
        }
    }

    $(function(){
        search.init();

        $('#objType').live('change', function(){
            var obj_type_id = $(this).val();
            if(typeof searchCache[obj_type_id] == 'undefined'){
                $.ajax({
                    url: BASE_URL + '/quicksearch/main/loadForm?' + $('#search-form').serialize(),
                    dataType: 'json',
                    type: 'GET',
                    data: { obj_type_id: obj_type_id, is_inner: 0, compact: advancedIsOpen ? 0 : 1 },
                    success: function(data){
                        if(data.status == 'ok'){
                            searchCache[obj_type_id] = [];
                            searchCache[obj_type_id].html = data.html;
                            searchCache[obj_type_id].sliderRangeFields = data.sliderRangeFields;
                            searchCache[obj_type_id].cityField = data.cityField;
                            searchCache[obj_type_id].countFiled = data.countFiled;
                            search.renderForm(obj_type_id);
                        }
                    }
                })
            } else {
                search.renderForm(obj_type_id);
            }
        });

        if(isInner){
            $("#more-options-link-inner, #more-options-img").live('click', function(){
                if (advancedIsOpen) {
                    search.innerSetNormal();
                } else {
                    search.innerSetAdvanced();
                }
            });
        } else {
            $("#more-options-link").live('click', function(){
                if(advancedIsOpen){
                    search.indexSetNormal();
                } else {
                    search.indexSetAdvanced();
                }
            });
        }

        if(isInner && !compact){
            search.innerSetAdvanced();
        }
    });