
    var zTree;
	var demoIframe;
	// var base  = getRootPath();
	var base  = $('#flow_list_tree').attr('base');

	// var basepath = base+ '/' + treeNode.controller + '/';
	var basepath = base+ '/';

	var setting = {
		async: {
        enable: true,
        url: getUrl
	    },
	    view: {
	        selectedMulti: false,
			//addHoverDom: addHoverDom,
			//removeHoverDom: removeHoverDom,
	    },
	    edit: {
	        enable: true,
	        showRemoveBtn: false,
			// removeTitle: setRemoveTitle,
			// showRenameBtn: true,
			// renameTitle: setRenameTitle
	    },
	    data: {
	        simpleData: {
	            enable: true
	        }
	    },
		callback: 
		{
			beforeClick: beforeClick,
			beforeDrag: beforeDrag,
			beforeRename: zTreeBeforeRename,
			onRename: zTreeOnRename,
			beforeRemove: zTreeBeforeRemove,
			onRemove: zTreeOnRemove
		}
	};

	function getUrl(treeId, treeNode){
	    var parma = $('#flow_list_tree').attr('url');
	    if( typeof(treeNode) != 'undefined' ){
    		// parma = base+ '/' + treeNode.url;
    		parma = base+ '/' + treeNode.controller + '/' + treeNode.url;
	    }
	    return parma;
	}

	function beforeClick(treeId, treeNode) {
				var zTree = $.fn.zTree.getZTreeObj("flow_list_tree");
				if (treeNode.isParent) {
					zTree.expandNode(treeNode);
					return false;
				} else {
					path = base+'/'+treeNode.controller+'/'+treeNode.file;
					// path = base+'/'+treeNode.file;
					demoIframe.attr("src",path);
					return true;
				}
			}

	function beforeDrag(treeId, treeNodes) {
			return false;
		}

	function setRemoveTitle(treeId, treeNode) {
		return treeNode.isParent ? "删除父节点":"删除叶子节点";
	}

	function setRenameTitle(treeId, treeNode) {
		return treeNode.isParent ? "编辑父节点名称":"编辑叶子节点名称";
	}

	function zTreeBeforeRename(treeId, treeNode, newName, isCancel) {
		// alert(treeNode.id + ", " + treeNode.controller+ ", " + treeNode.url);
		return newName.length > 0;
	}

	function zTreeOnRename(event, treeId, treeNode, isCancel) {


        if(treeNode.id != 0)
        {
            $.post(basepath+'ajax_rename_flow',
            	{'id': treeNode.id,'flows_name': treeNode.name},function(e){
            	// alert(e);
            	if(e==1){alert(treeNode.name+''+'名称修改成功');}else{alert(treeNode.name+''+'名称修改失败');}
            },'html');
		
        }
	
	}

	function zTreeBeforeRemove(treeId, treeNode) {

		if(treeNode.id == 0)
		{
			return false;
		}

		if(confirm('是否删除'+treeNode.name+'节点？'))
		{
			return true;
		}
		return false;
	}

	function zTreeOnRemove(event, treeId, treeNode) {

        $.post(basepath+'ajax_flow_delete',{'id': treeNode.id},function(e){
        	if(e==1){alert(treeNode.name+'删除成功');}else{alert(treeNode.name+'删除失败');}
        },'html');
		
	}

	
	var zNodes =[
		{name:"科目列表", id:"0",isParent:true,controller:'Itembanks',url:'paper_subject_list',getSubsetUrl:'/Itembanks/paper_subject_list',file:'/Itembanks/subject_management'}
	];

	$(document).ready(function(){

		App.init();
		var t = $("#flow_list_tree");
		t = $.fn.zTree.init(t, setting, zNodes);

		demoIframe = $("#testIframe");
		demoIframe.bind("load", loadReady);
		var zTree = $.fn.zTree.getZTreeObj("flow_list_tree");
		zTree.selectNode(zTree.getNodeByParam("id", 1));

	});

	function loadReady() {
		var bodyH = demoIframe.contents().find("body").get(0).scrollHeight,
		htmlH = demoIframe.contents().find("html").get(0).scrollHeight,
		maxH = Math.max(bodyH, htmlH), minH = Math.min(bodyH, htmlH),
		h = demoIframe.height() >= maxH ? minH:maxH ;
		if (h < 530) h = 530;
		demoIframe.height(h);
	}


		