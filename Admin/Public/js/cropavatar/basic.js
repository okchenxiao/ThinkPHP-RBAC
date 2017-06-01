$(function(){

    $("#fileimg").change(function(){
          var objUrl = getObjectURL(this.files[0]) ;
          console.log("objUrl = "+objUrl);

        if (objUrl) {
        var img = new Image();
        img.src = objUrl;
        img.onload = function(){

        $.session.set('imgwidth', img.width);
        $.session.set('imgheight', img.height);
        //图片加载之后载入截图插件
        cutImage($(".jcrop_w>img"));
        var _Jw = ($("#imtarget").width() - 135) / 2 ,
            _Jh = ($("#imtarget").height() - 135) / 2 ,
            _Jw2 = _Jw + 135,
            _Jh2 = _Jh + 135;
        $('#imtarget').Jcrop({
        setSelect: [_Jw, _Jh, _Jw2, _Jh2],
        onChange: showPreview,
        onSelect: showPreview,
        bgFade: true,
        bgColor: "white",
        aspectRatio: 1,
        bgOpacity: .5,
        //allowResize:false,
        allowSelect:false
        });
        $("#target_tips").hide();
        $("#tips").hide();
        $("#photo_tips").hide();
        $("#photo1_tips").hide();
        $("#photo2_tips").hide();

        $("#photo_target").attr("width", img.width);
        $("#photo_target").attr("height",img.height);
        };

        $("#photo_target").attr("src", objUrl);
        $("#photo").attr("src", objUrl) ;
        $("#photo1").attr("src", objUrl) ;
        $("#photo2").attr("src", objUrl) ;
        $("#photo3").attr("value", objUrl);
        $("#avtar_form").attr("style","display:block;");

        }
    }) ;

});
//图片旋转
function imgRotate(deg){
    var img1 = $(".jcrop_w>img"),
        _data = parseInt($(".jc-demo-box").attr("data"));
    if($.browser.version == 8.0 || $.browser.version == 7.0 || $.browser.version == 6.0 ){
        var sin = Math.sin(Math.PI / 180 * (_data + deg)), cos = Math.cos(Math.PI / 180 * (_data + deg));
        var _filter = "progid:DXImageTransform.Microsoft.Matrix(M11=" + cos + "," +  "M12=" + (-sin)
            + ",M21=" + sin+ ",M22=" + cos + ",SizingMethod='auto expand')";
        img1.css({
            filter: _filter
        });
        $('.pre-1 img,.pre-2 img,.pre-3 img').css({
            filter: _filter
        });

    }else{
        var _deg = deg + _data;
        var _val =  "rotate("+ _deg + "deg)";
        img1.css({
            "-webkit-transform": _val,
               "-moz-transform": _val,
                "-ms-transform": _val,
                 "-o-transform": _val,
                    "transform": _val
        });
        $('.pre-1 img,.pre-2 img,.pre-3 img').css({
            "-webkit-transform": _val,
               "-moz-transform": _val,
                "-ms-transform": _val,
                 "-o-transform": _val,
                    "transform": _val
        });
    }

    var     fiw = $('.jcrop_w>img').width(),
            fih = $('.jcrop_w>img').height(),
            ow = Math.floor((395 - fiw) / 2),
            oh = Math.floor((340 - fih) / 2),
            cx = $("#small").position().left,
            cy = $("#small").position().top,
            rx = 110 / $("#small").width(),
            ry = 135 / $("#small").height(),
            rx1 = 73 / $("#small").width(),
            ry1 = 90 / $("#small").height(),
            rx2 = 40 / $("#small").width(),
            ry2 = 48 / $("#small").height();



    if($.browser.version == 8.0 || $.browser.version == 7.0 || $.browser.version == 6.0){
        pre_img2($('.pre-1 img'), rx, fih, ry, fiw, cx, cy, ow, oh);
        pre_img2($('.pre-2 img'), rx1, fih, ry1, fiw, cx, cy, ow, oh);
        pre_img2($('.pre-3 img'), rx2,  fih, ry2, fiw, cx, cy, ow, oh);
    }else{
        pre_img2($('.pre-1 img'), rx, fiw, ry, fih, cx, cy, ow, oh);
        pre_img2($('.pre-2 img'), rx1, fiw, ry1, fih, cx, cy, ow, oh);
        pre_img2($('.pre-3 img'), rx2, fiw, ry2, fih, cx, cy, ow, oh);
    }

    $(".jcrop_w img").css({
        left: ow,
        top: oh
    });

    if( deg > 0){
        if(_data == 270){
            _data = 0;
        }else{
            _data = _data + 90;
        }
    }else{
        if(_data == 0){
            _data = 270;
        }else{
            _data = _data - 90;
        }
    }
	$("#d").val(_data);
    $(".jc-demo-box").attr("data", _data);
}

//放大缩小图片
function imgToSize(size) {
    var iw = $('.jcrop_w>img').width(),
        ih = $('.jcrop_w>img').height(),
        _data = $(".jc-demo-box").attr("data"),
        _w = Math.round(iw + size),
        _h = Math.round(((iw + size) * ih) / iw);

    if(($.browser.version == 8.0 || $.browser.version == 7.0 || $.browser.version == 6.0) && (_data == 90 || _data == 270)){
        $('.jcrop_w>img').width(_h).height(_w);
    }else{
        $('.jcrop_w>img').width(_w).height(_h);
    }

    var     fiw = $('.jcrop_w>img').width(),
            fih = $('.jcrop_w>img').height(),
            ow = (395 - fiw) / 2,
            oh = (340 - fih) / 2,
            cx = $("#small").position().left,
            cy = $("#small").position().top,
            rx = 110 / $("#small").width(),
            ry = 135 / $("#small").height(),
            rx1 = 73 / $("#small").width(),
            ry1 = 90 / $("#small").height(),
            rx2 = 40 / $("#small").width(),
            ry2 = 48 / $("#small").height();

    if(($.browser.version == 8.0 || $.browser.version == 7.0 || $.browser.version == 6.0) && (_data == 90 || _data == 270)){
        pre_img2($('.pre-1 img'), rx, fih, ry, fiw, cx, cy, ow, oh);
        pre_img2($('.pre-2 img'), rx1, fih, ry1, fiw, cx, cy, ow, oh);
        pre_img2($('.pre-3 img'), rx2, fih, ry2, fiw, cx, cy, ow, oh);
    }else{
        pre_img2($('.pre-1 img'), rx, fiw, ry, fih, cx, cy, ow, oh);
        pre_img2($('.pre-2 img'), rx1, fiw, ry1, fih, cx, cy, ow, oh);
        pre_img2($('.pre-3 img'), rx2,  fiw, ry2, fih, cx, cy, ow, oh);
    }
    $(".jcrop_w img").css({
        left: ow,
        top: oh
    });

};

        //
function pre_img2(obj, rx, iw, ry, ih, cx, cy, ow, oh){
            obj.css({
                width: Math.round(rx * iw) + 'px',
                height: Math.round(ry * ih) + 'px'
            });
            if( cy >= oh && cx >= ow){
                obj.css({
                    marginLeft: '-' + Math.round(rx * (cx - ow)) + 'px',
                    marginTop: '-' + Math.round(ry * (cy - oh)) + 'px'
                });
            }else if( cy <= oh && cx >= ow){
                obj.css({
                    marginLeft: "-" + Math.round(rx * (cx - ow)) + 'px',
                    marginTop: Math.round(ry * (oh - cy)) + 'px'
                });
            }else if( cy >= oh && cx <= ow){
                obj.css({
                    marginLeft: Math.round(rx * (ow - cx)) + 'px',
                    marginTop: '-' + Math.round(ry * (cy - oh)) + 'px'
                });
            }else if( cy <= oh && cx <= ow){
                obj.css({
                    marginLeft: Math.round(rx * (ow - cx)) + 'px',
                    marginTop: Math.round(ry * (oh - cy)) + 'px'
                });
            }

        };
//默认图像位置
function cutImage(obj) {
    var w = 395,
        h = 340,
        iw = parseInt($.session.get('imgwidth')),
        ih = parseInt($.session.get('imgheight'));
    if(iw > w || ih > h){
        if(iw / ih > w / h){
            obj.css({
                width: w,
                height: w * ih / iw,
                top: (h - (w * ih / iw)) / 2,
                left: 0
            });
        }else{
            obj.css({
                height: h,
                width: h * iw / ih,
                top: 0,
                left: (w - (h * iw / ih)) / 2
            });
        }
    }else{
        obj.css({
            left: (w - iw) / 2,
            top: (h - ih ) / 2
        });
    }
}
function showPreview(c){
	var iw = $('.jcrop_w>img').width(),
		ih = $('.jcrop_w>img').height(),
        ow = (395 - iw) / 2,
        oh = (340 - ih) / 2,
		rx = 110 / c.w,
		ry = 135 / c.h,
		rx1 = 73 / c.w,
		ry1 = 90 / c.h,
		rx2 = 40 / c.w,
		ry2 = 48 / c.h,
		_data = $(".jc-demo-box").attr("data");

	if(($.browser.version == 8.0 || $.browser.version == 7.0 || $.browser.version == 6.0) && (_data == 90 || _data == 270)){
		pre_img2($('.pre-1 img'), rx, ih, ry, iw, c.x, c.y, ow, oh);
		pre_img2($('.pre-2 img'), rx1, ih, ry1, iw, c.x, c.y, ow, oh);
		pre_img2($('.pre-3 img'), rx2, ih, ry2, iw, c.x, c.y, ow, oh);
	}else{
		pre_img2($('.pre-1 img'), rx, iw, ry, ih, c.x, c.y, ow, oh);
		pre_img2($('.pre-2 img'), rx1, iw, ry1, ih, c.x, c.y, ow, oh);
		pre_img2($('.pre-3 img'), rx2, iw, ry2, ih, c.x, c.y, ow, oh);
	}
	$('#x').val(c.x);
	$('#y').val(c.y);
	$('#w').val(c.w);
	$('#h').val(c.h);
}

function getObjectURL(file) {
  var url = null ; 
  if (window.createObjectURL!=undefined) { // basic
    url = window.createObjectURL(file);
  } else if (window.URL!=undefined) { // mozilla(firefox)
    url = window.URL.createObjectURL(file) ;
  } else if (window.webkitURL!=undefined) { // webkit or chrome
    url = window.webkitURL.createObjectURL(file) ;
  }
  return url ;
}