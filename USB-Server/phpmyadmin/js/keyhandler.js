AJAX.registerTeardown("keyhandler.js",function(){$("#table_columns").die("keydown keyup");$("table.insertRowTable").die("keydown keyup")});AJAX.registerOnload("keyhandler.js",function(){$("#table_columns").live("keydown keyup",function(a){onKeyDownArrowsHandler(a.originalEvent)});$("table.insertRowTable").live("keydown keyup",function(a){onKeyDownArrowsHandler(a.originalEvent)})});function onKeyDownArrowsHandler(d){d=d||window.event;var f=(d.srcElement||d.target);if(!f){return}if(f.tagName!="TEXTAREA"&&f.tagName!="INPUT"&&f.tagName!="SELECT"){return}console.log(d);if(navigator.userAgent.toLowerCase().indexOf("applewebkit/")!=-1){if(d.ctrlKey||d.shiftKey||!d.altKey){return}}else{if(!d.ctrlKey||d.shiftKey||d.altKey){return}}if(!f.id){return}var i=f.id.split("_");if(i[0]!="field"||typeof i[2]=="undefined"){return}var b=i[2],h=i[1];var c=null;switch(d.keyCode){case 38:h--;break;case 40:h++;break;case 37:b--;break;case 39:b++;break;default:return}var a=navigator.userAgent.toLowerCase().indexOf("firefox/")>-1;if(a&&d.type=="keyup"){f.selectedIndex=window["selectedIndex_"+f.id]}var g="field_"+h+"_"+b;c=document.getElementById(g);if(!c){g="field_"+h+"_"+b+"_0";c=document.getElementById(g)}if(!c){return}if(d.type=="keydown"){c.focus();if(a){window["selectedIndex_"+c.id]=c.selectedIndex}}if(c.tagName!="SELECT"){c.select()}d.returnValue=false};