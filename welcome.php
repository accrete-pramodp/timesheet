<?php session_start();

include_once('header.php');

require 'vendor/autoload.php';

$client = new MongoDB\Client;

//************FIND DOCUMENTS*****************
$timesheetdb = $client->timesheet;
$tsdatacollection = $timesheetdb->tsusers;

$documentlists = $tsdatacollection->find();

$department = array();
//$projects = array();
//$entry_type = array();

foreach($documentlists as $doc){
	
	$department[] = $doc->edept;
	//$projects[] = $doc->projects;
	//$entry_type[] = $doc->type;
}

$dept_names = array_filter(array_unique($department));
//$projects_names = array_unique($projects);
//$entry_type_names = array_unique($entry_type);
?>
   
<div class="container-fluid body-content" style="padding-right: 50px; min-height:500px; overflow-y:scroll;">
	<div class="center-block loading-indicator hide">
		<div id="spinPageContent" class="loading-indicator-target"></div>
	</div>
	<div class="fullscreen ng-scope">
		<div>
    		<ol class="breadcrumb" style="padding-top:0px;">
				<li>
					<a href="#/">Home</a>
				</li>
				<li >
					<span>Timesheet View</span>
				</li>
			</ol>    
		</div>

		<div>
			<div>
        <h3 class="PageHeading">Timesheet View</h3>
        <hr>
    </div>
    <form name="Timesheetview">
        <fieldset>
            <div class="well" style="min-height:120px;">
                <div class="form-group">
                    <label class="col-md-1" style="padding-left:20px;">Department:</label>
                    <div class="col-md-3">
                        <select class="form-control" style="width:80%" id="dept_name">
                        	<option value="" class="" selected="selected">-- All --</option>
                        	<?php 
                        	foreach($dept_names as $dept_name) {	?>
							<option value="<?php echo $dept_name; ?>"><?php echo $dept_name; ?></option>
							<?php } ?>
                        </select>
                    </div>

                    <label class="col-md-1" style="padding-left:20px;">Project :</label>
                    <div class="col-md-2">
                        <select class="form-control" style="width:116%" id="projects">
                        	<option value="" class="" selected="selected">-- All --</option>
                        </select>
                    </div>

                    <label class="col-md-1" style="padding-left:3px; margin-left: 98px;">Entry Type:</label>
                    <div class="col-md-2">
                        <select class="form-control" name="EntryType">
                        	<option value="" class="" selected="selected">-- All --</option>
                        	<option value="string:BILL" label="Billable">Billable</option>
                        	<option value="string:INTRL" label="Internal">Internal</option>
                        </select>
                    </div>
                </div>
                <br>
                <div class="form-group" style="margin-top: 20px;">
                    <label class="col-md-1" style="padding-left:0px;">Start Date:</label>
                    <div class="col-md-3">
                        <input customdatepicker="" name="StartDate" class="font-fontawesome font-light radius3" onclick="SetEnddate()" id="dp1523534938627" type="text">
                        <button type="button" class="ui-datepicker-trigger"><i class="glyphicon glyphicon-calendar"></i></button>
                    </div>

                    <label class="col-md-1" style="padding-left:9px;">End Date:</label>
                    <div class="col-md-3">
                        <input customdatepicker="" name="EndDate" class="font-fontawesome font-light radius3" id="dp1523534938628" type="text">
                        <button type="button" class="ui-datepicker-trigger"><i class="glyphicon glyphicon-calendar"></i></button>
                    </div>

                    <div class="col-md-4" style="padding-left:0px;">
                        <input value="Search" class="btn btn-primary" onclick="searchtimesheet()" title="Search Timesheet" type="submit">

                        <a class="btn btn-primary" href="/#/timesheetview/addupdatetimesheet" title="Add Timesheet" style="margin-left: 5%;">Add Timesheet</a>

                        <button onclick="export()" class="btn btn-warning hide" style="MARGIN-LEFT: 5%;background-color: #E8A317;border-color: #E8A317;" title="Export Data to Excel as see in the Grid">Export Report</button>
                        <div class="col-md-2">
                            <div id="spinwrapper" class="center-block hide"><div id="spinContent"></div></div>
                        </div>
                    </div>
                </div>
            </div>

			<div ui-i18n="en" class="mygrid ui-grid grid1523534939775" id="grid1" ui-grid="gridTimeSheet" ui-grid-exporter="" style="margin-bottom: 2%;"><style ui-grid-style="">.grid1523534939775 {
    }

    .grid1523534939775 .ui-grid-row, .grid1523534939775 .ui-grid-cell, .grid1523534939775 .ui-grid-cell .ui-grid-vertical-bar {
      height: 30px;
    }

    .grid1523534939775 .ui-grid-row:last-child .ui-grid-cell {
      border-bottom-width: 0px;
    }
    
 .grid1523534939775 .ui-grid-coluiGrid-0006 { min-width: 134px; max-width: 134px; } .grid1523534939775 .ui-grid-coluiGrid-0007 { min-width: 134px; max-width: 134px; } .grid1523534939775 .ui-grid-coluiGrid-0009 { min-width: 146px; max-width: 146px; } .grid1523534939775 .ui-grid-coluiGrid-000A { min-width: 73px; max-width: 73px; } .grid1523534939775 .ui-grid-coluiGrid-000B { min-width: 122px; max-width: 122px; } .grid1523534939775 .ui-grid-coluiGrid-000C { min-width: 85px; max-width: 85px; } .grid1523534939775 .ui-grid-coluiGrid-000D { min-width: 134px; max-width: 134px; } .grid1523534939775 .ui-grid-coluiGrid-000E { min-width: 73px; max-width: 73px; } .grid1523534939775 .ui-grid-coluiGrid-000F { min-width: 134px; max-width: 134px; } .grid1523534939775 .ui-grid-coluiGrid-000G { min-width: 85px; max-width: 85px; } .grid1523534939775 .ui-grid-coluiGrid-000I { min-width: 73px; max-width: 73px; } .grid1523534939775 .ui-grid-coluiGrid-000J { min-width: 85px; max-width: 85px; }

 .grid1523534939775 .ui-grid-render-container-body .ui-grid-canvas { width: 1278px; height: 0px; }
 .grid1523534939775 .ui-grid-render-container-body .ui-grid-header-canvas { width: 1295px; }
 .grid1523534939775 .ui-grid-render-container-body .ui-grid-header-canvas { height: inherit; }
 .grid1523534939775 .ui-grid-render-container-body .ui-grid-viewport { width: 1237px; height: 324px; }
 .grid1523534939775 .ui-grid-render-container-body .ui-grid-header-viewport { width: 1237px; }
 .grid1523534939775 .ui-grid-render-container-body .ui-grid-footer-canvas { width: 1295px; }
 .grid1523534939775 .ui-grid-render-container-body .ui-grid-footer-viewport { width: 1237px; }
.grid1523534939775 .ui-grid-footer-aggregates-row { height: 30px; } .grid1523534939775 .ui-grid-footer-info { height: 30px; }
 .grid1523534939775 .ui-grid-coluiGrid-0006 { min-width: 134px; max-width: 134px; } .grid1523534939775 .ui-grid-coluiGrid-0007 { min-width: 134px; max-width: 134px; } .grid1523534939775 .ui-grid-coluiGrid-0009 { min-width: 146px; max-width: 146px; } .grid1523534939775 .ui-grid-coluiGrid-000A { min-width: 73px; max-width: 73px; } .grid1523534939775 .ui-grid-coluiGrid-000B { min-width: 122px; max-width: 122px; } .grid1523534939775 .ui-grid-coluiGrid-000C { min-width: 85px; max-width: 85px; } .grid1523534939775 .ui-grid-coluiGrid-000D { min-width: 134px; max-width: 134px; } .grid1523534939775 .ui-grid-coluiGrid-000E { min-width: 73px; max-width: 73px; } .grid1523534939775 .ui-grid-coluiGrid-000F { min-width: 134px; max-width: 134px; } .grid1523534939775 .ui-grid-coluiGrid-000G { min-width: 85px; max-width: 85px; } .grid1523534939775 .ui-grid-coluiGrid-000I { min-width: 73px; max-width: 73px; } .grid1523534939775 .ui-grid-coluiGrid-000J { min-width: 85px; max-width: 85px; }</style><div class="ui-grid-contents-wrapper"><!-- ngIf: grid.options.enableGridMenu --><div class="ui-grid-menu-button" ui-grid-menu-button="" ng-if="grid.options.enableGridMenu"><div role="button" ui-grid-one-bind-id-grid="'grid-menu'" class="ui-grid-icon-container" ng-click="toggleMenu()" aria-haspopup="true" id="1523534939775-grid-menu"><i class="ui-grid-icon-menu" ui-grid-one-bind-aria-label="i18n.aria.buttonLabel" aria-label="Grid Menu">&nbsp;</i></div><div ui-grid-menu="" menu-items="menuItems" class="ng-isolate-scope"><!-- ngIf: shown --></div></div><!-- end ngIf: grid.options.enableGridMenu --><!-- ngIf: grid.hasLeftContainer() --><div role="grid" ui-grid-one-bind-id-grid="'grid-container'" class="ui-grid-render-container ng-isolate-scope ui-grid-render-container-body" ng-style="{ 'margin-left': colContainer.getMargin('left') + 'px', 'margin-right': colContainer.getMargin('right') + 'px' }" ui-grid-render-container="" container-id="'body'" col-container-name="'body'" row-container-name="'body'" bind-scroll-horizontal="true" bind-scroll-vertical="true" enable-horizontal-scrollbar="grid.options.enableHorizontalScrollbar" enable-vertical-scrollbar="grid.options.enableVerticalScrollbar" id="1523534939775-grid-container" style="margin-left: 0px; margin-right: 0px;"><!-- All of these dom elements are replaced in place --><div role="rowgroup" class="ui-grid-header ng-scope"><!-- theader --><div class="ui-grid-top-panel"><div class="ui-grid-header-viewport"><div class="ui-grid-header-canvas"><div class="ui-grid-header-cell-wrapper" ng-style="colContainer.headerCellWrapperStyle()"><div role="row" class="ui-grid-header-cell-row"><!-- ngRepeat: col in colContainer.renderedColumns track by col.uid --><div class="ui-grid-header-cell ui-grid-clearfix ng-scope ng-isolate-scope ui-grid-coluiGrid-0006" ng-repeat="col in colContainer.renderedColumns track by col.uid" ui-grid-header-cell="" col="col" render-index="$index"><div role="columnheader" ng-class="{ 'sortable': sortable }" ui-grid-one-bind-aria-labelledby-grid="col.uid + '-header-text ' + col.uid + '-sortdir-text'" aria-sort="descending" class="ng-scope sortable" aria-labelledby="1523534939775-uiGrid-0006-header-text 1523534939775-uiGrid-0006-sortdir-text"><div role="button" tabindex="0" class="ui-grid-cell-contents ui-grid-header-cell-primary-focus" col-index="renderIndex"><span ui-grid-one-bind-id-grid="col.uid + '-header-text'" class="ng-binding" id="1523534939775-uiGrid-0006-header-text">Date</span> <span ui-grid-one-bind-id-grid="col.uid + '-sortdir-text'" ui-grid-visible="col.sort.direction" aria-label="Sort Descending. Priority: 2" id="1523534939775-uiGrid-0006-sortdir-text"><i ng-class="{ 'ui-grid-icon-up-dir': col.sort.direction == asc, 'ui-grid-icon-down-dir': col.sort.direction == desc, 'ui-grid-icon-blank': !col.sort.direction }" title="Priority: 2" aria-hidden="true" class="ui-grid-icon-down-dir">&nbsp;</i></span></div><!-- ngIf: grid.options.enableColumnMenus && !col.isRowHeader  && col.colDef.enableColumnMenu !== false --><div role="button" tabindex="0" ui-grid-one-bind-id-grid="col.uid + '-menu-button'" class="ui-grid-column-menu-button ng-scope" ng-if="grid.options.enableColumnMenus &amp;&amp; !col.isRowHeader  &amp;&amp; col.colDef.enableColumnMenu !== false" ng-click="toggleMenu($event)" ng-class="{'ui-grid-column-menu-button-last-col': isLastCol}" ui-grid-one-bind-aria-label="i18n.headerCell.aria.columnMenuButtonLabel" aria-haspopup="true" id="1523534939775-uiGrid-0006-menu-button" aria-label="Column Menu"><i class="ui-grid-icon-angle-down" aria-hidden="true">&nbsp;</i></div><!-- end ngIf: grid.options.enableColumnMenus && !col.isRowHeader  && col.colDef.enableColumnMenu !== false --><div ui-grid-filter=""></div></div><!-- ngIf: grid.options.enableColumnResizing --><div ui-grid-column-resizer="" ng-if="grid.options.enableColumnResizing" class="ui-grid-column-resizer ng-scope ng-isolate-scope right" col="col" position="right" render-index="renderIndex" unselectable="on"></div><!-- end ngIf: grid.options.enableColumnResizing --></div><!-- end ngRepeat: col in colContainer.renderedColumns track by col.uid --><div class="ui-grid-header-cell ui-grid-clearfix ng-scope ng-isolate-scope ui-grid-coluiGrid-0007" ng-repeat="col in colContainer.renderedColumns track by col.uid" ui-grid-header-cell="" col="col" render-index="$index"><!-- ngIf: grid.options.enableColumnResizing --><div ui-grid-column-resizer="" ng-if="grid.options.enableColumnResizing" class="ui-grid-column-resizer ng-scope ng-isolate-scope left" col="col" position="left" render-index="renderIndex" unselectable="on"></div><!-- end ngIf: grid.options.enableColumnResizing --><div role="columnheader" ng-class="{ 'sortable': sortable }" ui-grid-one-bind-aria-labelledby-grid="col.uid + '-header-text ' + col.uid + '-sortdir-text'" aria-sort="none" class="ng-scope sortable" aria-labelledby="1523534939775-uiGrid-0007-header-text 1523534939775-uiGrid-0007-sortdir-text"><div role="button" tabindex="0" class="ui-grid-cell-contents ui-grid-header-cell-primary-focus" col-index="renderIndex"><span ui-grid-one-bind-id-grid="col.uid + '-header-text'" class="ng-binding" id="1523534939775-uiGrid-0007-header-text">Project</span> <span ui-grid-one-bind-id-grid="col.uid + '-sortdir-text'" ui-grid-visible="col.sort.direction" aria-label="Sort None" class="ui-grid-invisible" id="1523534939775-uiGrid-0007-sortdir-text"><i ng-class="{ 'ui-grid-icon-up-dir': col.sort.direction == asc, 'ui-grid-icon-down-dir': col.sort.direction == desc, 'ui-grid-icon-blank': !col.sort.direction }" title="" aria-hidden="true" class="ui-grid-icon-blank">&nbsp;</i></span></div><!-- ngIf: grid.options.enableColumnMenus && !col.isRowHeader  && col.colDef.enableColumnMenu !== false --><div role="button" tabindex="0" ui-grid-one-bind-id-grid="col.uid + '-menu-button'" class="ui-grid-column-menu-button ng-scope" ng-if="grid.options.enableColumnMenus &amp;&amp; !col.isRowHeader  &amp;&amp; col.colDef.enableColumnMenu !== false" ng-click="toggleMenu($event)" ng-class="{'ui-grid-column-menu-button-last-col': isLastCol}" ui-grid-one-bind-aria-label="i18n.headerCell.aria.columnMenuButtonLabel" aria-haspopup="true" id="1523534939775-uiGrid-0007-menu-button" aria-label="Column Menu"><i class="ui-grid-icon-angle-down" aria-hidden="true">&nbsp;</i></div><!-- end ngIf: grid.options.enableColumnMenus && !col.isRowHeader  && col.colDef.enableColumnMenu !== false --><div ui-grid-filter=""><!-- ngRepeat: colFilter in col.filters --><div class="ui-grid-filter-container ng-scope" ng-repeat="colFilter in col.filters" ng-class="{'ui-grid-filter-cancel-button-hidden' : colFilter.disableCancelFilterButton === true }"><!-- ngIf: colFilter.type !== 'select' --><div ng-if="colFilter.type !== 'select'" class="ng-scope"><input class="ui-grid-filter-input ui-grid-filter-input-0" ng-model="colFilter.term" ng-attr-placeholder="{{colFilter.placeholder || ''}}" aria-label="Filter for column" placeholder="" type="text"><!-- ngIf: !colFilter.disableCancelFilterButton --><div role="button" class="ui-grid-filter-button ng-scope ng-hide" ng-click="removeFilter(colFilter, $index)" ng-if="!colFilter.disableCancelFilterButton" ng-disabled="colFilter.term === undefined || colFilter.term === null || colFilter.term === ''" ng-show="colFilter.term !== undefined &amp;&amp; colFilter.term !== null &amp;&amp; colFilter.term !== ''" disabled="disabled"><i class="ui-grid-icon-cancel" ui-grid-one-bind-aria-label="aria.removeFilter" aria-label="Remove Filter">&nbsp;</i></div><!-- end ngIf: !colFilter.disableCancelFilterButton --></div><!-- end ngIf: colFilter.type !== 'select' --><!-- ngIf: colFilter.type === 'select' --></div><!-- end ngRepeat: colFilter in col.filters --></div></div><!-- ngIf: grid.options.enableColumnResizing --><div ui-grid-column-resizer="" ng-if="grid.options.enableColumnResizing" class="ui-grid-column-resizer ng-scope ng-isolate-scope right" col="col" position="right" render-index="renderIndex" unselectable="on"></div><!-- end ngIf: grid.options.enableColumnResizing --></div><!-- end ngRepeat: col in colContainer.renderedColumns track by col.uid --><div class="ui-grid-header-cell ui-grid-clearfix ng-scope ng-isolate-scope ui-grid-coluiGrid-0009" ng-repeat="col in colContainer.renderedColumns track by col.uid" ui-grid-header-cell="" col="col" render-index="$index"><!-- ngIf: grid.options.enableColumnResizing --><div ui-grid-column-resizer="" ng-if="grid.options.enableColumnResizing" class="ui-grid-column-resizer ng-scope ng-isolate-scope left" col="col" position="left" render-index="renderIndex" unselectable="on"></div><!-- end ngIf: grid.options.enableColumnResizing --><div role="columnheader" ng-class="{ 'sortable': sortable }" ui-grid-one-bind-aria-labelledby-grid="col.uid + '-header-text ' + col.uid + '-sortdir-text'" aria-sort="none" class="ng-scope sortable" aria-labelledby="1523534939775-uiGrid-0009-header-text 1523534939775-uiGrid-0009-sortdir-text"><div role="button" tabindex="0" class="ui-grid-cell-contents ui-grid-header-cell-primary-focus" col-index="renderIndex"><span ui-grid-one-bind-id-grid="col.uid + '-header-text'" class="ng-binding" id="1523534939775-uiGrid-0009-header-text">Task Overview</span> <span ui-grid-one-bind-id-grid="col.uid + '-sortdir-text'" ui-grid-visible="col.sort.direction" aria-label="Sort None" class="ui-grid-invisible" id="1523534939775-uiGrid-0009-sortdir-text"><i ng-class="{ 'ui-grid-icon-up-dir': col.sort.direction == asc, 'ui-grid-icon-down-dir': col.sort.direction == desc, 'ui-grid-icon-blank': !col.sort.direction }" title="" aria-hidden="true" class="ui-grid-icon-blank">&nbsp;</i></span></div><!-- ngIf: grid.options.enableColumnMenus && !col.isRowHeader  && col.colDef.enableColumnMenu !== false --><div role="button" tabindex="0" ui-grid-one-bind-id-grid="col.uid + '-menu-button'" class="ui-grid-column-menu-button ng-scope" ng-if="grid.options.enableColumnMenus &amp;&amp; !col.isRowHeader  &amp;&amp; col.colDef.enableColumnMenu !== false" ng-click="toggleMenu($event)" ng-class="{'ui-grid-column-menu-button-last-col': isLastCol}" ui-grid-one-bind-aria-label="i18n.headerCell.aria.columnMenuButtonLabel" aria-haspopup="true" id="1523534939775-uiGrid-0009-menu-button" aria-label="Column Menu"><i class="ui-grid-icon-angle-down" aria-hidden="true">&nbsp;</i></div><!-- end ngIf: grid.options.enableColumnMenus && !col.isRowHeader  && col.colDef.enableColumnMenu !== false --><div ui-grid-filter=""></div></div><!-- ngIf: grid.options.enableColumnResizing --><div ui-grid-column-resizer="" ng-if="grid.options.enableColumnResizing" class="ui-grid-column-resizer ng-scope ng-isolate-scope right" col="col" position="right" render-index="renderIndex" unselectable="on"></div><!-- end ngIf: grid.options.enableColumnResizing --></div><!-- end ngRepeat: col in colContainer.renderedColumns track by col.uid --><div class="ui-grid-header-cell ui-grid-clearfix ng-scope ng-isolate-scope ui-grid-coluiGrid-000A" ng-repeat="col in colContainer.renderedColumns track by col.uid" ui-grid-header-cell="" col="col" render-index="$index"><!-- ngIf: grid.options.enableColumnResizing --><div ui-grid-column-resizer="" ng-if="grid.options.enableColumnResizing" class="ui-grid-column-resizer ng-scope ng-isolate-scope left" col="col" position="left" render-index="renderIndex" unselectable="on"></div><!-- end ngIf: grid.options.enableColumnResizing --><div role="columnheader" ng-class="{ 'sortable': sortable }" ui-grid-one-bind-aria-labelledby-grid="col.uid + '-header-text ' + col.uid + '-sortdir-text'" aria-sort="none" class="ng-scope sortable" aria-labelledby="1523534939775-uiGrid-000A-header-text 1523534939775-uiGrid-000A-sortdir-text"><div role="button" tabindex="0" class="ui-grid-cell-contents ui-grid-header-cell-primary-focus" col-index="renderIndex"><span ui-grid-one-bind-id-grid="col.uid + '-header-text'" class="ng-binding" id="1523534939775-uiGrid-000A-header-text">Module</span> <span ui-grid-one-bind-id-grid="col.uid + '-sortdir-text'" ui-grid-visible="col.sort.direction" aria-label="Sort None" class="ui-grid-invisible" id="1523534939775-uiGrid-000A-sortdir-text"><i ng-class="{ 'ui-grid-icon-up-dir': col.sort.direction == asc, 'ui-grid-icon-down-dir': col.sort.direction == desc, 'ui-grid-icon-blank': !col.sort.direction }" title="" aria-hidden="true" class="ui-grid-icon-blank">&nbsp;</i></span></div><!-- ngIf: grid.options.enableColumnMenus && !col.isRowHeader  && col.colDef.enableColumnMenu !== false --><div role="button" tabindex="0" ui-grid-one-bind-id-grid="col.uid + '-menu-button'" class="ui-grid-column-menu-button ng-scope" ng-if="grid.options.enableColumnMenus &amp;&amp; !col.isRowHeader  &amp;&amp; col.colDef.enableColumnMenu !== false" ng-click="toggleMenu($event)" ng-class="{'ui-grid-column-menu-button-last-col': isLastCol}" ui-grid-one-bind-aria-label="i18n.headerCell.aria.columnMenuButtonLabel" aria-haspopup="true" id="1523534939775-uiGrid-000A-menu-button" aria-label="Column Menu"><i class="ui-grid-icon-angle-down" aria-hidden="true">&nbsp;</i></div><!-- end ngIf: grid.options.enableColumnMenus && !col.isRowHeader  && col.colDef.enableColumnMenu !== false --><div ui-grid-filter=""><!-- ngRepeat: colFilter in col.filters --><div class="ui-grid-filter-container ng-scope" ng-repeat="colFilter in col.filters" ng-class="{'ui-grid-filter-cancel-button-hidden' : colFilter.disableCancelFilterButton === true }"><!-- ngIf: colFilter.type !== 'select' --><div ng-if="colFilter.type !== 'select'" class="ng-scope"><input class="ui-grid-filter-input ui-grid-filter-input-0" ng-model="colFilter.term" ng-attr-placeholder="{{colFilter.placeholder || ''}}" aria-label="Filter for column" placeholder="" type="text"><!-- ngIf: !colFilter.disableCancelFilterButton --><div role="button" class="ui-grid-filter-button ng-scope ng-hide" ng-click="removeFilter(colFilter, $index)" ng-if="!colFilter.disableCancelFilterButton" ng-disabled="colFilter.term === undefined || colFilter.term === null || colFilter.term === ''" ng-show="colFilter.term !== undefined &amp;&amp; colFilter.term !== null &amp;&amp; colFilter.term !== ''" disabled="disabled"><i class="ui-grid-icon-cancel" ui-grid-one-bind-aria-label="aria.removeFilter" aria-label="Remove Filter">&nbsp;</i></div><!-- end ngIf: !colFilter.disableCancelFilterButton --></div><!-- end ngIf: colFilter.type !== 'select' --><!-- ngIf: colFilter.type === 'select' --></div><!-- end ngRepeat: colFilter in col.filters --></div></div><!-- ngIf: grid.options.enableColumnResizing --><div ui-grid-column-resizer="" ng-if="grid.options.enableColumnResizing" class="ui-grid-column-resizer ng-scope ng-isolate-scope right" col="col" position="right" render-index="renderIndex" unselectable="on"></div><!-- end ngIf: grid.options.enableColumnResizing --></div><!-- end ngRepeat: col in colContainer.renderedColumns track by col.uid --><div class="ui-grid-header-cell ui-grid-clearfix ng-scope ng-isolate-scope ui-grid-coluiGrid-000B" ng-repeat="col in colContainer.renderedColumns track by col.uid" ui-grid-header-cell="" col="col" render-index="$index"><!-- ngIf: grid.options.enableColumnResizing --><div ui-grid-column-resizer="" ng-if="grid.options.enableColumnResizing" class="ui-grid-column-resizer ng-scope ng-isolate-scope left" col="col" position="left" render-index="renderIndex" unselectable="on"></div><!-- end ngIf: grid.options.enableColumnResizing --><div role="columnheader" ng-class="{ 'sortable': sortable }" ui-grid-one-bind-aria-labelledby-grid="col.uid + '-header-text ' + col.uid + '-sortdir-text'" aria-sort="none" class="ng-scope sortable" aria-labelledby="1523534939775-uiGrid-000B-header-text 1523534939775-uiGrid-000B-sortdir-text"><div role="button" tabindex="0" class="ui-grid-cell-contents ui-grid-header-cell-primary-focus" col-index="renderIndex"><span ui-grid-one-bind-id-grid="col.uid + '-header-text'" class="ng-binding" id="1523534939775-uiGrid-000B-header-text">Task Details</span> <span ui-grid-one-bind-id-grid="col.uid + '-sortdir-text'" ui-grid-visible="col.sort.direction" aria-label="Sort None" class="ui-grid-invisible" id="1523534939775-uiGrid-000B-sortdir-text"><i ng-class="{ 'ui-grid-icon-up-dir': col.sort.direction == asc, 'ui-grid-icon-down-dir': col.sort.direction == desc, 'ui-grid-icon-blank': !col.sort.direction }" title="" aria-hidden="true" class="ui-grid-icon-blank">&nbsp;</i></span></div><!-- ngIf: grid.options.enableColumnMenus && !col.isRowHeader  && col.colDef.enableColumnMenu !== false --><div role="button" tabindex="0" ui-grid-one-bind-id-grid="col.uid + '-menu-button'" class="ui-grid-column-menu-button ng-scope" ng-if="grid.options.enableColumnMenus &amp;&amp; !col.isRowHeader  &amp;&amp; col.colDef.enableColumnMenu !== false" ng-click="toggleMenu($event)" ng-class="{'ui-grid-column-menu-button-last-col': isLastCol}" ui-grid-one-bind-aria-label="i18n.headerCell.aria.columnMenuButtonLabel" aria-haspopup="true" id="1523534939775-uiGrid-000B-menu-button" aria-label="Column Menu"><i class="ui-grid-icon-angle-down" aria-hidden="true">&nbsp;</i></div><!-- end ngIf: grid.options.enableColumnMenus && !col.isRowHeader  && col.colDef.enableColumnMenu !== false --><div ui-grid-filter=""></div></div><!-- ngIf: grid.options.enableColumnResizing --><div ui-grid-column-resizer="" ng-if="grid.options.enableColumnResizing" class="ui-grid-column-resizer ng-scope ng-isolate-scope right" col="col" position="right" render-index="renderIndex" unselectable="on"></div><!-- end ngIf: grid.options.enableColumnResizing --></div><!-- end ngRepeat: col in colContainer.renderedColumns track by col.uid --><div class="ui-grid-header-cell ui-grid-clearfix ng-scope ng-isolate-scope ui-grid-coluiGrid-000C" ng-repeat="col in colContainer.renderedColumns track by col.uid" ui-grid-header-cell="" col="col" render-index="$index"><!-- ngIf: grid.options.enableColumnResizing --><div ui-grid-column-resizer="" ng-if="grid.options.enableColumnResizing" class="ui-grid-column-resizer ng-scope ng-isolate-scope left" col="col" position="left" render-index="renderIndex" unselectable="on"></div><!-- end ngIf: grid.options.enableColumnResizing --><div role="columnheader" ng-class="{ 'sortable': sortable }" ui-grid-one-bind-aria-labelledby-grid="col.uid + '-header-text ' + col.uid + '-sortdir-text'" aria-sort="none" class="ng-scope sortable" aria-labelledby="1523534939775-uiGrid-000C-header-text 1523534939775-uiGrid-000C-sortdir-text"><div role="button" tabindex="0" class="ui-grid-cell-contents ui-grid-header-cell-primary-focus" col-index="renderIndex"><span ui-grid-one-bind-id-grid="col.uid + '-header-text'" class="ng-binding" id="1523534939775-uiGrid-000C-header-text">Hours</span> <span ui-grid-one-bind-id-grid="col.uid + '-sortdir-text'" ui-grid-visible="col.sort.direction" aria-label="Sort None" class="ui-grid-invisible" id="1523534939775-uiGrid-000C-sortdir-text"><i ng-class="{ 'ui-grid-icon-up-dir': col.sort.direction == asc, 'ui-grid-icon-down-dir': col.sort.direction == desc, 'ui-grid-icon-blank': !col.sort.direction }" title="" aria-hidden="true" class="ui-grid-icon-blank">&nbsp;</i></span></div><!-- ngIf: grid.options.enableColumnMenus && !col.isRowHeader  && col.colDef.enableColumnMenu !== false --><div role="button" tabindex="0" ui-grid-one-bind-id-grid="col.uid + '-menu-button'" class="ui-grid-column-menu-button ng-scope" ng-if="grid.options.enableColumnMenus &amp;&amp; !col.isRowHeader  &amp;&amp; col.colDef.enableColumnMenu !== false" ng-click="toggleMenu($event)" ng-class="{'ui-grid-column-menu-button-last-col': isLastCol}" ui-grid-one-bind-aria-label="i18n.headerCell.aria.columnMenuButtonLabel" aria-haspopup="true" id="1523534939775-uiGrid-000C-menu-button" aria-label="Column Menu"><i class="ui-grid-icon-angle-down" aria-hidden="true">&nbsp;</i></div><!-- end ngIf: grid.options.enableColumnMenus && !col.isRowHeader  && col.colDef.enableColumnMenu !== false --><div ui-grid-filter=""></div></div><!-- ngIf: grid.options.enableColumnResizing --><div ui-grid-column-resizer="" ng-if="grid.options.enableColumnResizing" class="ui-grid-column-resizer ng-scope ng-isolate-scope right" col="col" position="right" render-index="renderIndex" unselectable="on"></div><!-- end ngIf: grid.options.enableColumnResizing --></div><!-- end ngRepeat: col in colContainer.renderedColumns track by col.uid --><div class="ui-grid-header-cell ui-grid-clearfix ng-scope ng-isolate-scope ui-grid-coluiGrid-000D" ng-repeat="col in colContainer.renderedColumns track by col.uid" ui-grid-header-cell="" col="col" render-index="$index"><!-- ngIf: grid.options.enableColumnResizing --><div ui-grid-column-resizer="" ng-if="grid.options.enableColumnResizing" class="ui-grid-column-resizer ng-scope ng-isolate-scope left" col="col" position="left" render-index="renderIndex" unselectable="on"></div><!-- end ngIf: grid.options.enableColumnResizing --><div role="columnheader" ng-class="{ 'sortable': sortable }" ui-grid-one-bind-aria-labelledby-grid="col.uid + '-header-text ' + col.uid + '-sortdir-text'" aria-sort="none" class="ng-scope sortable" aria-labelledby="1523534939775-uiGrid-000D-header-text 1523534939775-uiGrid-000D-sortdir-text"><div role="button" tabindex="0" class="ui-grid-cell-contents ui-grid-header-cell-primary-focus" col-index="renderIndex"><span ui-grid-one-bind-id-grid="col.uid + '-header-text'" class="ng-binding" id="1523534939775-uiGrid-000D-header-text">Billable Id</span> <span ui-grid-one-bind-id-grid="col.uid + '-sortdir-text'" ui-grid-visible="col.sort.direction" aria-label="Sort None" class="ui-grid-invisible" id="1523534939775-uiGrid-000D-sortdir-text"><i ng-class="{ 'ui-grid-icon-up-dir': col.sort.direction == asc, 'ui-grid-icon-down-dir': col.sort.direction == desc, 'ui-grid-icon-blank': !col.sort.direction }" title="" aria-hidden="true" class="ui-grid-icon-blank">&nbsp;</i></span></div><!-- ngIf: grid.options.enableColumnMenus && !col.isRowHeader  && col.colDef.enableColumnMenu !== false --><div role="button" tabindex="0" ui-grid-one-bind-id-grid="col.uid + '-menu-button'" class="ui-grid-column-menu-button ng-scope" ng-if="grid.options.enableColumnMenus &amp;&amp; !col.isRowHeader  &amp;&amp; col.colDef.enableColumnMenu !== false" ng-click="toggleMenu($event)" ng-class="{'ui-grid-column-menu-button-last-col': isLastCol}" ui-grid-one-bind-aria-label="i18n.headerCell.aria.columnMenuButtonLabel" aria-haspopup="true" id="1523534939775-uiGrid-000D-menu-button" aria-label="Column Menu"><i class="ui-grid-icon-angle-down" aria-hidden="true">&nbsp;</i></div><!-- end ngIf: grid.options.enableColumnMenus && !col.isRowHeader  && col.colDef.enableColumnMenu !== false --><div ui-grid-filter=""><!-- ngRepeat: colFilter in col.filters --><div class="ui-grid-filter-container ng-scope" ng-repeat="colFilter in col.filters" ng-class="{'ui-grid-filter-cancel-button-hidden' : colFilter.disableCancelFilterButton === true }"><!-- ngIf: colFilter.type !== 'select' --><div ng-if="colFilter.type !== 'select'" class="ng-scope"><input class="ui-grid-filter-input ui-grid-filter-input-0" ng-model="colFilter.term" ng-attr-placeholder="{{colFilter.placeholder || ''}}" aria-label="Filter for column" placeholder="" type="text"><!-- ngIf: !colFilter.disableCancelFilterButton --><div role="button" class="ui-grid-filter-button ng-scope ng-hide" ng-click="removeFilter(colFilter, $index)" ng-if="!colFilter.disableCancelFilterButton" ng-disabled="colFilter.term === undefined || colFilter.term === null || colFilter.term === ''" ng-show="colFilter.term !== undefined &amp;&amp; colFilter.term !== null &amp;&amp; colFilter.term !== ''" disabled="disabled"><i class="ui-grid-icon-cancel" ui-grid-one-bind-aria-label="aria.removeFilter" aria-label="Remove Filter">&nbsp;</i></div><!-- end ngIf: !colFilter.disableCancelFilterButton --></div><!-- end ngIf: colFilter.type !== 'select' --><!-- ngIf: colFilter.type === 'select' --></div><!-- end ngRepeat: colFilter in col.filters --></div></div><!-- ngIf: grid.options.enableColumnResizing --><div ui-grid-column-resizer="" ng-if="grid.options.enableColumnResizing" class="ui-grid-column-resizer ng-scope ng-isolate-scope right" col="col" position="right" render-index="renderIndex" unselectable="on"></div><!-- end ngIf: grid.options.enableColumnResizing --></div><!-- end ngRepeat: col in colContainer.renderedColumns track by col.uid --><div class="ui-grid-header-cell ui-grid-clearfix ng-scope ng-isolate-scope ui-grid-coluiGrid-000E" ng-repeat="col in colContainer.renderedColumns track by col.uid" ui-grid-header-cell="" col="col" render-index="$index"><!-- ngIf: grid.options.enableColumnResizing --><div ui-grid-column-resizer="" ng-if="grid.options.enableColumnResizing" class="ui-grid-column-resizer ng-scope ng-isolate-scope left" col="col" position="left" render-index="renderIndex" unselectable="on"></div><!-- end ngIf: grid.options.enableColumnResizing --><div role="columnheader" ng-class="{ 'sortable': sortable }" ui-grid-one-bind-aria-labelledby-grid="col.uid + '-header-text ' + col.uid + '-sortdir-text'" aria-sort="none" class="ng-scope sortable" aria-labelledby="1523534939775-uiGrid-000E-header-text 1523534939775-uiGrid-000E-sortdir-text"><div role="button" tabindex="0" class="ui-grid-cell-contents ui-grid-header-cell-primary-focus" col-index="renderIndex"><span ui-grid-one-bind-id-grid="col.uid + '-header-text'" class="ng-binding" id="1523534939775-uiGrid-000E-header-text">Entry Type</span> <span ui-grid-one-bind-id-grid="col.uid + '-sortdir-text'" ui-grid-visible="col.sort.direction" aria-label="Sort None" class="ui-grid-invisible" id="1523534939775-uiGrid-000E-sortdir-text"><i ng-class="{ 'ui-grid-icon-up-dir': col.sort.direction == asc, 'ui-grid-icon-down-dir': col.sort.direction == desc, 'ui-grid-icon-blank': !col.sort.direction }" title="" aria-hidden="true" class="ui-grid-icon-blank">&nbsp;</i></span></div><!-- ngIf: grid.options.enableColumnMenus && !col.isRowHeader  && col.colDef.enableColumnMenu !== false --><div role="button" tabindex="0" ui-grid-one-bind-id-grid="col.uid + '-menu-button'" class="ui-grid-column-menu-button ng-scope" ng-if="grid.options.enableColumnMenus &amp;&amp; !col.isRowHeader  &amp;&amp; col.colDef.enableColumnMenu !== false" ng-click="toggleMenu($event)" ng-class="{'ui-grid-column-menu-button-last-col': isLastCol}" ui-grid-one-bind-aria-label="i18n.headerCell.aria.columnMenuButtonLabel" aria-haspopup="true" id="1523534939775-uiGrid-000E-menu-button" aria-label="Column Menu"><i class="ui-grid-icon-angle-down" aria-hidden="true">&nbsp;</i></div><!-- end ngIf: grid.options.enableColumnMenus && !col.isRowHeader  && col.colDef.enableColumnMenu !== false --><div ui-grid-filter=""></div></div><!-- ngIf: grid.options.enableColumnResizing --><div ui-grid-column-resizer="" ng-if="grid.options.enableColumnResizing" class="ui-grid-column-resizer ng-scope ng-isolate-scope right" col="col" position="right" render-index="renderIndex" unselectable="on"></div><!-- end ngIf: grid.options.enableColumnResizing --></div><!-- end ngRepeat: col in colContainer.renderedColumns track by col.uid --><div class="ui-grid-header-cell ui-grid-clearfix ng-scope ng-isolate-scope ui-grid-coluiGrid-000F" ng-repeat="col in colContainer.renderedColumns track by col.uid" ui-grid-header-cell="" col="col" render-index="$index"><!-- ngIf: grid.options.enableColumnResizing --><div ui-grid-column-resizer="" ng-if="grid.options.enableColumnResizing" class="ui-grid-column-resizer ng-scope ng-isolate-scope left" col="col" position="left" render-index="renderIndex" unselectable="on"></div><!-- end ngIf: grid.options.enableColumnResizing --><div role="columnheader" ng-class="{ 'sortable': sortable }" ui-grid-one-bind-aria-labelledby-grid="col.uid + '-header-text ' + col.uid + '-sortdir-text'" aria-sort="none" class="ng-scope sortable" aria-labelledby="1523534939775-uiGrid-000F-header-text 1523534939775-uiGrid-000F-sortdir-text"><div role="button" tabindex="0" class="ui-grid-cell-contents ui-grid-header-cell-primary-focus" col-index="renderIndex"><span ui-grid-one-bind-id-grid="col.uid + '-header-text'" class="ng-binding" id="1523534939775-uiGrid-000F-header-text">Added By</span> <span ui-grid-one-bind-id-grid="col.uid + '-sortdir-text'" ui-grid-visible="col.sort.direction" aria-label="Sort None" class="ui-grid-invisible" id="1523534939775-uiGrid-000F-sortdir-text"><i ng-class="{ 'ui-grid-icon-up-dir': col.sort.direction == asc, 'ui-grid-icon-down-dir': col.sort.direction == desc, 'ui-grid-icon-blank': !col.sort.direction }" title="" aria-hidden="true" class="ui-grid-icon-blank">&nbsp;</i></span></div><!-- ngIf: grid.options.enableColumnMenus && !col.isRowHeader  && col.colDef.enableColumnMenu !== false --><div role="button" tabindex="0" ui-grid-one-bind-id-grid="col.uid + '-menu-button'" class="ui-grid-column-menu-button ng-scope" ng-if="grid.options.enableColumnMenus &amp;&amp; !col.isRowHeader  &amp;&amp; col.colDef.enableColumnMenu !== false" ng-click="toggleMenu($event)" ng-class="{'ui-grid-column-menu-button-last-col': isLastCol}" ui-grid-one-bind-aria-label="i18n.headerCell.aria.columnMenuButtonLabel" aria-haspopup="true" id="1523534939775-uiGrid-000F-menu-button" aria-label="Column Menu"><i class="ui-grid-icon-angle-down" aria-hidden="true">&nbsp;</i></div><!-- end ngIf: grid.options.enableColumnMenus && !col.isRowHeader  && col.colDef.enableColumnMenu !== false --><div ui-grid-filter=""><!-- ngRepeat: colFilter in col.filters --><div class="ui-grid-filter-container ng-scope" ng-repeat="colFilter in col.filters" ng-class="{'ui-grid-filter-cancel-button-hidden' : colFilter.disableCancelFilterButton === true }"><!-- ngIf: colFilter.type !== 'select' --><div ng-if="colFilter.type !== 'select'" class="ng-scope"><input class="ui-grid-filter-input ui-grid-filter-input-0" ng-model="colFilter.term" ng-attr-placeholder="{{colFilter.placeholder || ''}}" aria-label="Filter for column" placeholder="" type="text"><!-- ngIf: !colFilter.disableCancelFilterButton --><div role="button" class="ui-grid-filter-button ng-scope ng-hide" ng-click="removeFilter(colFilter, $index)" ng-if="!colFilter.disableCancelFilterButton" ng-disabled="colFilter.term === undefined || colFilter.term === null || colFilter.term === ''" ng-show="colFilter.term !== undefined &amp;&amp; colFilter.term !== null &amp;&amp; colFilter.term !== ''" disabled="disabled"><i class="ui-grid-icon-cancel" ui-grid-one-bind-aria-label="aria.removeFilter" aria-label="Remove Filter">&nbsp;</i></div><!-- end ngIf: !colFilter.disableCancelFilterButton --></div><!-- end ngIf: colFilter.type !== 'select' --><!-- ngIf: colFilter.type === 'select' --></div><!-- end ngRepeat: colFilter in col.filters --></div></div><!-- ngIf: grid.options.enableColumnResizing --><div ui-grid-column-resizer="" ng-if="grid.options.enableColumnResizing" class="ui-grid-column-resizer ng-scope ng-isolate-scope right" col="col" position="right" render-index="renderIndex" unselectable="on"></div><!-- end ngIf: grid.options.enableColumnResizing --></div><!-- end ngRepeat: col in colContainer.renderedColumns track by col.uid --><div class="ui-grid-header-cell ui-grid-clearfix ng-scope ng-isolate-scope ui-grid-coluiGrid-000G" ng-repeat="col in colContainer.renderedColumns track by col.uid" ui-grid-header-cell="" col="col" render-index="$index"><!-- ngIf: grid.options.enableColumnResizing --><div ui-grid-column-resizer="" ng-if="grid.options.enableColumnResizing" class="ui-grid-column-resizer ng-scope ng-isolate-scope left" col="col" position="left" render-index="renderIndex" unselectable="on"></div><!-- end ngIf: grid.options.enableColumnResizing --><div role="columnheader" ng-class="{ 'sortable': sortable }" ui-grid-one-bind-aria-labelledby-grid="col.uid + '-header-text ' + col.uid + '-sortdir-text'" aria-sort="ascending" class="ng-scope sortable" aria-labelledby="1523534939775-uiGrid-000G-header-text 1523534939775-uiGrid-000G-sortdir-text"><div role="button" tabindex="0" class="ui-grid-cell-contents ui-grid-header-cell-primary-focus" col-index="renderIndex"><span ui-grid-one-bind-id-grid="col.uid + '-header-text'" class="ng-binding" id="1523534939775-uiGrid-000G-header-text">Status</span> <span ui-grid-one-bind-id-grid="col.uid + '-sortdir-text'" ui-grid-visible="col.sort.direction" aria-label="Sort Ascending. Priority: 1" id="1523534939775-uiGrid-000G-sortdir-text"><i ng-class="{ 'ui-grid-icon-up-dir': col.sort.direction == asc, 'ui-grid-icon-down-dir': col.sort.direction == desc, 'ui-grid-icon-blank': !col.sort.direction }" title="Priority: 1" aria-hidden="true" class="ui-grid-icon-up-dir">&nbsp;</i></span></div><!-- ngIf: grid.options.enableColumnMenus && !col.isRowHeader  && col.colDef.enableColumnMenu !== false --><div role="button" tabindex="0" ui-grid-one-bind-id-grid="col.uid + '-menu-button'" class="ui-grid-column-menu-button ng-scope" ng-if="grid.options.enableColumnMenus &amp;&amp; !col.isRowHeader  &amp;&amp; col.colDef.enableColumnMenu !== false" ng-click="toggleMenu($event)" ng-class="{'ui-grid-column-menu-button-last-col': isLastCol}" ui-grid-one-bind-aria-label="i18n.headerCell.aria.columnMenuButtonLabel" aria-haspopup="true" id="1523534939775-uiGrid-000G-menu-button" aria-label="Column Menu"><i class="ui-grid-icon-angle-down" aria-hidden="true">&nbsp;</i></div><!-- end ngIf: grid.options.enableColumnMenus && !col.isRowHeader  && col.colDef.enableColumnMenu !== false --><div ui-grid-filter=""><!-- ngRepeat: colFilter in col.filters --><div class="ui-grid-filter-container ng-scope" ng-repeat="colFilter in col.filters" ng-class="{'ui-grid-filter-cancel-button-hidden' : colFilter.disableCancelFilterButton === true }"><!-- ngIf: colFilter.type !== 'select' --><div ng-if="colFilter.type !== 'select'" class="ng-scope"><input class="ui-grid-filter-input ui-grid-filter-input-0" ng-model="colFilter.term" ng-attr-placeholder="{{colFilter.placeholder || ''}}" aria-label="Filter for column" placeholder="" type="text"><!-- ngIf: !colFilter.disableCancelFilterButton --><div role="button" class="ui-grid-filter-button ng-scope ng-hide" ng-click="removeFilter(colFilter, $index)" ng-if="!colFilter.disableCancelFilterButton" ng-disabled="colFilter.term === undefined || colFilter.term === null || colFilter.term === ''" ng-show="colFilter.term !== undefined &amp;&amp; colFilter.term !== null &amp;&amp; colFilter.term !== ''" disabled="disabled"><i class="ui-grid-icon-cancel" ui-grid-one-bind-aria-label="aria.removeFilter" aria-label="Remove Filter">&nbsp;</i></div><!-- end ngIf: !colFilter.disableCancelFilterButton --></div><!-- end ngIf: colFilter.type !== 'select' --><!-- ngIf: colFilter.type === 'select' --></div><!-- end ngRepeat: colFilter in col.filters --></div></div><!-- ngIf: grid.options.enableColumnResizing --><div ui-grid-column-resizer="" ng-if="grid.options.enableColumnResizing" class="ui-grid-column-resizer ng-scope ng-isolate-scope right" col="col" position="right" render-index="renderIndex" unselectable="on"></div><!-- end ngIf: grid.options.enableColumnResizing --></div><!-- end ngRepeat: col in colContainer.renderedColumns track by col.uid --><div class="ui-grid-header-cell ui-grid-clearfix ng-scope ng-isolate-scope ui-grid-coluiGrid-000I GridAlignCenter" ng-repeat="col in colContainer.renderedColumns track by col.uid" ui-grid-header-cell="" col="col" render-index="$index"><!-- ngIf: grid.options.enableColumnResizing --><div ui-grid-column-resizer="" ng-if="grid.options.enableColumnResizing" class="ui-grid-column-resizer ng-scope ng-isolate-scope left" col="col" position="left" render-index="renderIndex" unselectable="on"></div><!-- end ngIf: grid.options.enableColumnResizing --><div role="columnheader" ng-class="{ 'sortable': sortable }" ui-grid-one-bind-aria-labelledby-grid="col.uid + '-header-text ' + col.uid + '-sortdir-text'" aria-sort="none" class="ng-scope" aria-labelledby="1523534939775-uiGrid-000I-header-text 1523534939775-uiGrid-000I-sortdir-text"><div role="button" tabindex="0" class="ui-grid-cell-contents ui-grid-header-cell-primary-focus" col-index="renderIndex"><span ui-grid-one-bind-id-grid="col.uid + '-header-text'" class="ng-binding" id="1523534939775-uiGrid-000I-header-text">Edit</span> <span ui-grid-one-bind-id-grid="col.uid + '-sortdir-text'" ui-grid-visible="col.sort.direction" aria-label="Sort None" class="ui-grid-invisible" id="1523534939775-uiGrid-000I-sortdir-text"><i ng-class="{ 'ui-grid-icon-up-dir': col.sort.direction == asc, 'ui-grid-icon-down-dir': col.sort.direction == desc, 'ui-grid-icon-blank': !col.sort.direction }" title="" aria-hidden="true" class="ui-grid-icon-blank">&nbsp;</i></span></div><!-- ngIf: grid.options.enableColumnMenus && !col.isRowHeader  && col.colDef.enableColumnMenu !== false --><div role="button" tabindex="0" ui-grid-one-bind-id-grid="col.uid + '-menu-button'" class="ui-grid-column-menu-button ng-scope" ng-if="grid.options.enableColumnMenus &amp;&amp; !col.isRowHeader  &amp;&amp; col.colDef.enableColumnMenu !== false" ng-click="toggleMenu($event)" ng-class="{'ui-grid-column-menu-button-last-col': isLastCol}" ui-grid-one-bind-aria-label="i18n.headerCell.aria.columnMenuButtonLabel" aria-haspopup="true" id="1523534939775-uiGrid-000I-menu-button" aria-label="Column Menu"><i class="ui-grid-icon-angle-down" aria-hidden="true">&nbsp;</i></div><!-- end ngIf: grid.options.enableColumnMenus && !col.isRowHeader  && col.colDef.enableColumnMenu !== false --><div ui-grid-filter=""></div></div><!-- ngIf: grid.options.enableColumnResizing --><div ui-grid-column-resizer="" ng-if="grid.options.enableColumnResizing" class="ui-grid-column-resizer ng-scope ng-isolate-scope right" col="col" position="right" render-index="renderIndex" unselectable="on"></div><!-- end ngIf: grid.options.enableColumnResizing --></div><!-- end ngRepeat: col in colContainer.renderedColumns track by col.uid --><div class="ui-grid-header-cell ui-grid-clearfix ng-scope ng-isolate-scope ui-grid-coluiGrid-000J GridAlignCenter" ng-repeat="col in colContainer.renderedColumns track by col.uid" ui-grid-header-cell="" col="col" render-index="$index"><!-- ngIf: grid.options.enableColumnResizing --><div ui-grid-column-resizer="" ng-if="grid.options.enableColumnResizing" class="ui-grid-column-resizer ng-scope ng-isolate-scope left" col="col" position="left" render-index="renderIndex" unselectable="on"></div><!-- end ngIf: grid.options.enableColumnResizing --><div role="columnheader" ng-class="{ 'sortable': sortable }" ui-grid-one-bind-aria-labelledby-grid="col.uid + '-header-text ' + col.uid + '-sortdir-text'" aria-sort="none" class="ng-scope" aria-labelledby="1523534939775-uiGrid-000J-header-text 1523534939775-uiGrid-000J-sortdir-text"><div role="button" tabindex="0" class="ui-grid-cell-contents ui-grid-header-cell-primary-focus" col-index="renderIndex"><span ui-grid-one-bind-id-grid="col.uid + '-header-text'" class="ng-binding" id="1523534939775-uiGrid-000J-header-text">Delete</span> <span ui-grid-one-bind-id-grid="col.uid + '-sortdir-text'" ui-grid-visible="col.sort.direction" aria-label="Sort None" class="ui-grid-invisible" id="1523534939775-uiGrid-000J-sortdir-text"><i ng-class="{ 'ui-grid-icon-up-dir': col.sort.direction == asc, 'ui-grid-icon-down-dir': col.sort.direction == desc, 'ui-grid-icon-blank': !col.sort.direction }" title="" aria-hidden="true" class="ui-grid-icon-blank">&nbsp;</i></span></div><!-- ngIf: grid.options.enableColumnMenus && !col.isRowHeader  && col.colDef.enableColumnMenu !== false --><div role="button" tabindex="0" ui-grid-one-bind-id-grid="col.uid + '-menu-button'" class="ui-grid-column-menu-button ng-scope ui-grid-column-menu-button-last-col" ng-if="grid.options.enableColumnMenus &amp;&amp; !col.isRowHeader  &amp;&amp; col.colDef.enableColumnMenu !== false" ng-click="toggleMenu($event)" ng-class="{'ui-grid-column-menu-button-last-col': isLastCol}" ui-grid-one-bind-aria-label="i18n.headerCell.aria.columnMenuButtonLabel" aria-haspopup="true" id="1523534939775-uiGrid-000J-menu-button" aria-label="Column Menu"><i class="ui-grid-icon-angle-down" aria-hidden="true">&nbsp;</i></div><!-- end ngIf: grid.options.enableColumnMenus && !col.isRowHeader  && col.colDef.enableColumnMenu !== false --><div ui-grid-filter=""></div></div><!-- ngIf: grid.options.enableColumnResizing --><div ui-grid-column-resizer="" ng-if="grid.options.enableColumnResizing" class="ui-grid-column-resizer ng-scope ng-isolate-scope right" col="col" position="right" render-index="renderIndex" unselectable="on"></div><!-- end ngIf: grid.options.enableColumnResizing --></div><!-- end ngRepeat: col in colContainer.renderedColumns track by col.uid --></div></div></div></div></div></div><div role="rowgroup" class="ui-grid-viewport ng-isolate-scope" ng-style="colContainer.getViewportStyle()" ui-grid-viewport="" style="overflow: scroll;"><!-- tbody --><div class="ui-grid-canvas"><!-- ngRepeat: (rowRenderIndex, row) in rowContainer.renderedRows track by $index --></div></div><!-- ngIf: colContainer.needsHScrollbarPlaceholder() --><!-- ngIf: grid.options.showColumnFooter --><ui-grid-footer ng-if="grid.options.showColumnFooter" class="ng-scope"><div class="ui-grid-footer-panel ui-grid-footer-aggregates-row ng-scope"><!-- tfooter --><div class="ui-grid-footer ui-grid-footer-viewport"><div class="ui-grid-footer-canvas"><div class="ui-grid-footer-cell-wrapper" ng-style="colContainer.headerCellWrapperStyle()"><div role="row" class="ui-grid-footer-cell-row"><!-- ngRepeat: col in colContainer.renderedColumns track by col.uid --><div ui-grid-footer-cell="" role="gridcell" ng-repeat="col in colContainer.renderedColumns track by col.uid" col="col" render-index="$index" class="ui-grid-footer-cell ui-grid-clearfix ng-scope ng-isolate-scope ui-grid-coluiGrid-0006"><div class="ui-grid-cell-contents ng-scope" col-index="renderIndex"><div class="ng-binding"></div></div></div><!-- end ngRepeat: col in colContainer.renderedColumns track by col.uid --><div ui-grid-footer-cell="" role="gridcell" ng-repeat="col in colContainer.renderedColumns track by col.uid" col="col" render-index="$index" class="ui-grid-footer-cell ui-grid-clearfix ng-scope ng-isolate-scope ui-grid-coluiGrid-0007"><div class="ui-grid-cell-contents ng-scope" col-index="renderIndex"><div class="ng-binding"></div></div></div><!-- end ngRepeat: col in colContainer.renderedColumns track by col.uid --><div ui-grid-footer-cell="" role="gridcell" ng-repeat="col in colContainer.renderedColumns track by col.uid" col="col" render-index="$index" class="ui-grid-footer-cell ui-grid-clearfix ng-scope ng-isolate-scope ui-grid-coluiGrid-0009"><div class="ui-grid-cell-contents ng-scope" col-index="renderIndex"><div class="ng-binding"></div></div></div><!-- end ngRepeat: col in colContainer.renderedColumns track by col.uid --><div ui-grid-footer-cell="" role="gridcell" ng-repeat="col in colContainer.renderedColumns track by col.uid" col="col" render-index="$index" class="ui-grid-footer-cell ui-grid-clearfix ng-scope ng-isolate-scope ui-grid-coluiGrid-000A"><div class="ui-grid-cell-contents ng-scope" col-index="renderIndex"><div class="ng-binding"></div></div></div><!-- end ngRepeat: col in colContainer.renderedColumns track by col.uid --><div ui-grid-footer-cell="" role="gridcell" ng-repeat="col in colContainer.renderedColumns track by col.uid" col="col" render-index="$index" class="ui-grid-footer-cell ui-grid-clearfix ng-scope ng-isolate-scope ui-grid-coluiGrid-000B"><div class="ui-grid-cell-contents ng-scope" col-index="renderIndex"><div class="ng-binding"></div></div></div><!-- end ngRepeat: col in colContainer.renderedColumns track by col.uid --><div ui-grid-footer-cell="" role="gridcell" ng-repeat="col in colContainer.renderedColumns track by col.uid" col="col" render-index="$index" class="ui-grid-footer-cell ui-grid-clearfix ng-scope ng-isolate-scope ui-grid-coluiGrid-000C"><div class="ui-grid-cell-contents ng-binding ng-scope">Total: 0</div></div><!-- end ngRepeat: col in colContainer.renderedColumns track by col.uid --><div ui-grid-footer-cell="" role="gridcell" ng-repeat="col in colContainer.renderedColumns track by col.uid" col="col" render-index="$index" class="ui-grid-footer-cell ui-grid-clearfix ng-scope ng-isolate-scope ui-grid-coluiGrid-000D"><div class="ui-grid-cell-contents ng-scope" col-index="renderIndex"><div class="ng-binding"></div></div></div><!-- end ngRepeat: col in colContainer.renderedColumns track by col.uid --><div ui-grid-footer-cell="" role="gridcell" ng-repeat="col in colContainer.renderedColumns track by col.uid" col="col" render-index="$index" class="ui-grid-footer-cell ui-grid-clearfix ng-scope ng-isolate-scope ui-grid-coluiGrid-000E"><div class="ui-grid-cell-contents ng-scope" col-index="renderIndex"><div class="ng-binding"></div></div></div><!-- end ngRepeat: col in colContainer.renderedColumns track by col.uid --><div ui-grid-footer-cell="" role="gridcell" ng-repeat="col in colContainer.renderedColumns track by col.uid" col="col" render-index="$index" class="ui-grid-footer-cell ui-grid-clearfix ng-scope ng-isolate-scope ui-grid-coluiGrid-000F"><div class="ui-grid-cell-contents ng-scope" col-index="renderIndex"><div class="ng-binding"></div></div></div><!-- end ngRepeat: col in colContainer.renderedColumns track by col.uid --><div ui-grid-footer-cell="" role="gridcell" ng-repeat="col in colContainer.renderedColumns track by col.uid" col="col" render-index="$index" class="ui-grid-footer-cell ui-grid-clearfix ng-scope ng-isolate-scope ui-grid-coluiGrid-000G"><div class="ui-grid-cell-contents ng-scope" col-index="renderIndex"><div class="ng-binding"></div></div></div><!-- end ngRepeat: col in colContainer.renderedColumns track by col.uid --><div ui-grid-footer-cell="" role="gridcell" ng-repeat="col in colContainer.renderedColumns track by col.uid" col="col" render-index="$index" class="ui-grid-footer-cell ui-grid-clearfix ng-scope ng-isolate-scope ui-grid-coluiGrid-000I"><div class="ui-grid-cell-contents ng-scope" col-index="renderIndex"><div class="ng-binding"></div></div></div><!-- end ngRepeat: col in colContainer.renderedColumns track by col.uid --><div ui-grid-footer-cell="" role="gridcell" ng-repeat="col in colContainer.renderedColumns track by col.uid" col="col" render-index="$index" class="ui-grid-footer-cell ui-grid-clearfix ng-scope ng-isolate-scope ui-grid-coluiGrid-000J"><div class="ui-grid-cell-contents ng-scope" col-index="renderIndex"><div class="ng-binding"></div></div></div><!-- end ngRepeat: col in colContainer.renderedColumns track by col.uid --></div></div></div></div></div></ui-grid-footer><!-- end ngIf: grid.options.showColumnFooter --></div><!-- ngIf: grid.hasRightContainer() --><!-- ngIf: grid.options.showGridFooter --><!-- ngIf: grid.options.enableColumnMenus --><div class="ui-grid-column-menu" ui-grid-column-menu="" ng-if="grid.options.enableColumnMenus"><div ui-grid-menu="" menu-items="menuItems" class="ng-isolate-scope"><!-- ngIf: shown --></div></div><!-- end ngIf: grid.options.enableColumnMenus --><div ng-transclude="">
                <div class="watermark ng-scope" ng-show="!data.length" style="top: 200px;">
                    No data available
                </div>
            </div></div></div><!-- end ngIf: !refresh -->

            <div style="margin-top:-11px; margin-bottom:11px;"><b>Note: </b>Approved Timesheets can not edited/deleted.</div>

        </fieldset>
    </form>

</div>

<!-- Modal -->
<div data-backdrop="static" data-keyboard="false" class="modal fade" id="DeleteTimesheetResult" role="dialog">
    <div class="modal-dialog modal-medium">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Delete Timesheet Record</h4>
            </div>
            <div class="modal-body">
                <i class="glyphicon glyphicon-remove-sign error alert-danger"></i>
                Are you sure want to delete timesheet record?
            </div>
            <div class="modal-footer">
                <a class="btn btn-primary">Yes</a>
                <a class="btn btn-default">No</a>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div data-backdrop="static" data-keyboard="false" class="modal fade" id="deleteTResult" role="dialog">
    <div class="modal-dialog modal-medium">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <i class="glyphicon glyphicon-remove-sign error alert-danger"></i>
                
                <br>

            </div>
            <div class="modal-footer">
                <input value="Ok" onclick="CloseDialogDeleteTResult()" class="btn btn-default btn-primary" type="submit">
            </div>
        </div>
    </div>
</div>
<!-- Timesheet Result Link Modal -->
<div data-backdrop="static" data-keyboard="false" class="modal fade" id="TimesheetResultLink" role="dialog">
    <div class="modal-dialog modal-medium">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Timesheet Report Link</h4>
            </div>
            <div class="modal-body">
                <i class="glyphicon glyphicon-remove-sign error alert-danger"></i>
                <span class="hide">Click on link to download reports: <a href=""> </a></span>
                <span class="hide"> </span>
            </div>
            <div class="modal-footer">
                <a class="btn btn-primary" onclick="CloseDialogTimesheetLink()">Ok</a>
            </div>
        </div>
    </div>
</div>


<div data-backdrop="static" data-keyboard="false" class="modal fade" id="DeleteTMST" role="dialog">
    <div class="modal-dialog modal-medium">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Delete Timesheet</h4>
            </div>
            <div class="modal-body">
                <i class="glyphicon glyphicon-warning-sign error alert-danger"></i>
                Do you want delete Timesheet?
            </div>
            <div class="modal-footer">
                <a class="btn btn-default" ng-click="CloseDialogDeleteConfYes()">Yes</a>
                <a class="btn btn-default" ng-click="CloseDialogDeleteConfNo()">No</a>
            </div>
        </div>
    </div>
</div>

<!-- Timesheet Result Link Modal -->
<div data-backdrop="static" data-keyboard="false" class="modal fade" id="ApprovalPendingTimesheet" role="dialog">
    <div class="modal-dialog modal-medium">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Timesheet Approval Pending List</h4>
            </div>
            <div class="modal-body" style="padding-top: 6px;">
                <span>
                    Timesheet approval pending from:
                    <!-- ngRepeat: itmMgr in ApprovalIdLst -->
                </span>
                <div>
                    <i class="glyphicon glyphicon-warning-sign alert-warning"></i>
                    Do you want to continue for Export Timesheet?
                </div>
            </div>
             
            <div class="modal-footer">
                <a class="btn btn-primary" onclick="CloseDialogApprovalPendingConfYes()">Yes</a>
                <a class="btn btn-primary" onclick="CloseDialogApprovalPendingConfNo()">No</a>
            </div>
        </div>
    </div>
</div></div>



    </div> 

    <footer class="navbar-fixed-bottom" style="background-color:#303030; color:white;">
        <section id="bottom" style="border-bottom: 5px solid #c52d2f;"></section>
        <div class="container" style="height:20px; padding-top:5px;">
            &copy; 2018 <a target="_blank" href="http://www.globalnestsolutions.com/" title="G N Solutions Pvt. Ltd." style="color:#c52d2f">G N Solutions Pvt. Ltd.</a> All Rights Reserved.
           
             <!--SD_11072017 Removed from Header and added to footer-->
            &nbsp;&nbsp;<span <li=""> <a href="/#/about">About Us</a>       </span> &nbsp;&nbsp;
            <span <li=""> <a href="/#/contact">Contact Us</a>  </span> &nbsp;&nbsp;
            <span <li=""> <a href="/#/helpdesk">Helpdesk</a>  </span> &nbsp;&nbsp;
            <!--SD_11072017 Removed from Header and added to footer-->

            <!-- ngIf: !($window.navigator.userAgent.indexOf('Chrome') > -1) --><span class="pull-right">1.0.8</span><!-- end ngIf: !($window.navigator.userAgent.indexOf('Chrome') > -1) -->
            <span class="pull-right messagealign">Best viewed in google chrome.</span>
        </div>
    </footer>

    <div class="modal fade" id="UserRoleResult" role="dialog">
        <div class="modal-dialog modal-medium">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Application Error</h4>
                </div>
                <div class="modal-body">
                    <i class="glyphicon glyphicon-remove-sign error alert-danger"></i>
                    Error ocurred while processing the request
                </div>
                <div class="modal-footer">
                    
                    <a class="btn btn-default" ng-click="CloseDialogRole()">Close</a>
                </div>
            </div>
        </div>
    </div>




<div id="ui-datepicker-div" class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all"></div>
<?php include_once('footer.php'); ?>
<script>
$(document).ready(function()
{
    $("#dept_name").change(function()
    {
        var deptartment_name = $('#dept_name :selected').val();
    	$.ajax({
			url: 'ajax_data.php',
			type: 'POST',
			async: false,
			data:{
    			content: 'get_dept_name',
    			dept_name: deptartment_name
			},
			success: function(response){
				var obj = jQuery.parseJSON( response );
				
				$.each(obj, function(index, value) {
					  $('#projects').append('<option value="'+value['projects']+'" class="">'+value['projects']+'</option>');
					});
			}
		});
    });
});
</script>