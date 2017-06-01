
//选择项目参与人员
var participants_setting = {
    async: {
        enable: true,
        url: getUrl
    },
    view: {
        selectedMulti: false
    },
    check: {
        enable: true
    },
    data: {
        simpleData: {
            enable: true
        }
    },
    callback: {
        onCheck: onCheck
    }
};

var zNodes =[];

// var zNodes =[{id:"1",name:"成都第一人民医院"},{id:"2",name:"成都第二人民医院"},{id:"3",name:"四川省第一人民医院"}];
function getUrl(treeId, treeNode){

    var parma = $('#participants_list').attr('url');
    if( typeof(treeNode) != 'undefined' ){
        parma = treeNode.getSubsetUrl + '/' + treeNode.id;
    }
    return parma;
}

function beforeClick(treeId, treeNode) {

    if( !treeNode.isParent ){
        $('#director_user_name').val(treeNode.name);
        $('#director_user_id').val(treeNode.id);
        $('#director_user_tel').val(treeNode.tel);
    }
    return !treeNode.isCur;
}
function onCheck(treeId, treeNode){

    var participants_user_name = Array();
    var participants_user_id = Array();
    $.each($.fn.zTree.getZTreeObj("participants_list").getCheckedNodes(true), function(i,obj){
        if( !obj.isParent ){
            participants_user_name.push(obj.name);
            participants_user_id.push(obj.id);
        }
    });
    $("#participants_user_name").val(participants_user_name.join("、"));
    $("#participants_user_id").val(participants_user_id.join(","));

}


$(document).ready(function(){

    $.fn.zTree.init($("#participants_list"), participants_setting, zNodes);
})
