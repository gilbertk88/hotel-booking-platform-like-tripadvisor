<?php
if((issetModule('location') && param('useLocation', 1))){ ?>
    <div class="<?php echo $divClass; ?>">
        <span class="search"><div class="<?php echo $textClass; ?>"><?php echo tc('Country') ?>:</div></span>

        <?php
        echo CHtml::dropDownList(
            'country',
            isset($this->selectedCountry)?$this->selectedCountry:'',
            Country::getCountriesArray(2),
            array('class' => $fieldClass . ' searchField', 'id' => 'country',
                'ajax' => array(
                    'type'=>'GET', //request type
                    'url'=>$this->createUrl('/location/main/getRegions'), //url to call.
                    //Style: CController::createUrl('currentController/methodToCall')
                    'data'=>'js:"country="+$("#country").val()+"&type=2"',
                    'success'=>'function(result){
							$("#region").html(result);
							$("#region").change();
						}'
                    //leave out the data key to pass all form values through
                )
            )
        );

        ?>
    </div>

    <div class="<?php echo $divClass; ?>">
        <span class="search"><div class="<?php echo $textClass; ?>"><?php echo tc('Region') ?>:</div></span>

        <?php
        echo CHtml::dropDownList(
            'region',
            isset($this->selectedRegion)?$this->selectedRegion:'',
            Region::getRegionsArray((isset($this->selectedCountry) ? $this->selectedCountry : 0), 2),
            array('class' => $fieldClass . ' searchField', 'id' => 'region',
                'ajax' => array(
                    'type'=>'GET', //request type
                    'url'=>$this->createUrl('/location/main/getCities'), //url to call.
                    //Style: CController::createUrl('currentController/methodToCall')
                    'data'=>'js:"region="+$("#region").val()+"&type=0"',
                    'success'=>'function(result){
                            changeSearch();
							$("#city").html(result);
							$("#city").multiselect("refresh");
						}'
                    //leave out the data key to pass all form values through
                )
            )
        );

        ?>
    </div>

<?php
}

?>

<div class="<?php echo $divClass; ?>">
    <span class="search"><div class="<?php echo $textClass; ?>"><?php echo Yii::t('common', 'City') ?>:</div></span>

    <?php

    echo CHtml::dropDownList(
        'city[]',
        isset($this->selectedCity)?$this->selectedCity:'',
        (issetModule('location') && param('useLocation', 1)) ?
            (City::getCitiesArray((isset($this->selectedRegion) ? $this->selectedRegion : 0), 0)) :
            $this->cityActive,
        array('class' => $fieldClass.' height17 searchField', 'multiple' => 'multiple')
    );

    SearchForm::setJsParam('cityField', array('minWidth' => $minWidth));

    ?>
</div>
