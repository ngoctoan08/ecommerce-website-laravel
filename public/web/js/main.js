// header-fixed 
$(window).scroll(function() {
    if ($(window).scrollTop() > 1)  {
        $('.header').addClass('header-fixed');
    } else {
        $('.header').removeClass('header-fixed');
    }
})

// search-header 
$(document).ready(function() {
    $(".icon-search").click(function() {
        let value = $(".form-inp-search").css("display");
        // console.log(value);
        if(value == "none"){
            $(".form-inp-search").css({
                'display' : 'flex'
            })
        } else {
            $(".form-inp-search").css({
                'display' : 'none'
            })
        }
    })
})

// menu-responsive
$(document).ready(function() {
    $(".icon-menu-respon > span").click(function() {
        let value = $(".box-list-menu-header").css("display");
        // console.log(value);
        if(value == "none"){
            $(".box-list-menu-header").css({
                'display' : 'flex'
            })
        } else {
            $(".box-list-menu-header").css({
                'display' : 'none'
            })
        }
    })

    $(".icon-close-menu-respon> span").click(function() {
        $(".box-list-menu-header").hide();

        $(".box-list-menu-header").click(function(event) {
            event.stopPropagation();
        })
    })
})

$(document).ready(function() {
    $('.icon-mini-menu').click(function() {
        $('.mini-box-list-menu').addClass('mini-box-list-menu-respon');
    })
})

// readmore 
$(document).ready(function() {
    $('.btn-readmore > span').click(function() {
        $('.post-product').addClass('readmore-post');
    })

    $('.btn-readmore-post > span').click(function() {
        $('.post-product').removeClass('readmore-post');
    })
})

$(document).ready(function() {
    $(".btn-readmore > span").click(function() {
        let value = $(".btn-readmore-post").css("display");
        // console.log(value);
        if(value == "none"){
            $(".btn-readmore-post").css({
                'display' : 'flex'
            })
        } else {
            $(".btn-readmore-post").css({
                'display' : 'none'
            })
        }
    })

    $(".btn-readmore-post").click(function() {
        $(".btn-readmore-post").hide();
    })
})


// choose img seen 
function changeImage(id) {
    let imagePath = document.getElementById(id).getAttribute('src');

    document.getElementById('img-main').setAttribute('src', imagePath);
}

// popup choose
$(document).ready(function() {
    $(".btn-tutorial-choose-size > span").click(function() {
        let value = $(".popup-choose-size").css("display");
        // console.log(value);
        if(value == "none"){
            $(".popup-choose-size").css({
                'display' : 'flex'
            })
        } else {
            $(".popup-choose-size").css({
                'display' : 'none'
            })
        }
    })

    $(".btn-close > span").click(function() {
        $(".popup-choose-size").hide();

        $(".popup-choose-size").click(function(event) {
            event.stopPropagation();
        })
    })
})

// popup check-user
$(document).ready(function() {
    $(".inp-write-review").click(function() {
        let value = $(".check-user").css("display");
        // console.log(value);
        if(value == "none"){
            $(".check-user").css({
                'display' : 'flex'
            })
        } else {
            $(".check-user").css({
                'display' : 'none'
            })
        }
    })

    $(".close-check-user").click(function() {
        $(".check-user").hide();

        $(".check-user").click(function(event) {
            event.stopPropagation();
        })
    })
})

$(document).ready(function() {
    $('.btn-pay').click(function() {
        $('.popup-pay-success').addClass('ant-popup-pay-success');
    })

    $('.btn-pay').click(function() {
        $('.pay-success').addClass('ant-pay-success');
    })
})

// popup-pay-success
// $(document).ready(function() {
//     // $(".order-product").click(function() {
//         $(".popup-pay-success").click(function() {
//             $(".popup-pay-success").hide();
    
//             $(".popup-pay-success").click(function(event) {
//                 event.stopPropagation();
//             })
//         // })
//     })
// })

// popup infor product
$(document).ready(function() {
    $(".icon-view-infor").click(function() {
        let value = $(".popup-infor-product").css("display");
        // console.log(value);
        if(value == "none"){
            $(".popup-infor-product").css({
                'display' : 'flex'
            })
        } else {
            $(".popup-infor-product").css({
                'display' : 'none'
            })
        }
    })

    $(".close-popup").click(function() {
        $(".popup-infor-product").hide();

        $(".popup-infor-product").click(function(event) {
            event.stopPropagation();
        })
    })
})


// choose-size 
$(document).ready(function() {
    $('.border-choose-size').click(function() {
        if($(this).hasClass(`active`)) {
            $(this).removeClass('active');
        }
        else {
            $('.border-choose-size').removeClass('active');
            $(this).addClass(`active`); 
        }
    })
})



// btn tăng giảm số lượng 
$('input.input-qty').each(function() {
    var $this = $(this),
        qty = $this.parent().find('.is-form'),
        min = Number($this.attr('min')),
        max = Number($this.attr('max'))
    if (min == 0) {
        var d = 0
    } else d = min
    $(qty).on('click', function() {
        if ($(this).hasClass('minus')) {
            if (d > min) d += -1
        } else if ($(this).hasClass('plus')) {
            var x = Number($this.val()) + 1
            if (x <= max) d += 1
        }
        $this.attr('value', d).val(d)
        $(`.qty-quick`).val(d)
    })
})



$(document).ready(function() {
    $('.list-menu-header li').click(function() {
    })
})


// range-input 
let min = 10;
let max = 100;

const calcLeftPosition = value => 100 / (100 - 10) * (value - 10);

$('#rangeMin').on('input', function(e) {
  const newValue = parseInt(e.target.value);
  if (newValue > max) return;
  min = newValue;
  $('#thumbMin').css('left', calcLeftPosition(newValue) + '%');
  $('#min').html(newValue);
  $('#line-range-input').css({
    'left': calcLeftPosition(newValue) + '%',
    'right': (100 - calcLeftPosition(max)) + '%'
  });
});

$('#rangeMax').on('input', function(e) {
  const newValue = parseInt(e.target.value);
  if (newValue < min) return;
  max = newValue;
  $('#thumbMax').css('left', calcLeftPosition(newValue) + '%');
  $('#max').html(newValue);
  $('#line-range-input').css({
    'left': calcLeftPosition(min) + '%',
    'right': (100 - calcLeftPosition(newValue)) + '%'
  });
});

$(document).ready(function() {
    $('.ul-star li').mouseover(function () { 
        let value = $(this).attr("data-val");
        $('.ul-star li').find("i").removeClass('fa-solid')
        $('.ul-star li').each(function(key, number) {
            if(key + 1 <= value)
            {
                $(this).find("i").addClass('fa-solid')
            }
        })
        $('.rate_score').val(value)
    })
})

document.getElementById('trigger_file').addEventListener('click', () => {
    document.getElementById('img_feedback').click()
  })


// animation success
$('.txt').html(function(i, html) {
    var chars = $.trim(html).split("");
  
    return '<span>' + chars.join('</span><span>') + '</span>';
  });



// lấy text ở api địa chỉ
// ValueId là id của select tỉnh, huyện...
// Text_id là id của input hidden
function getText(valueId ,text_id)
{
    const select = document.getElementById(valueId);
    document.getElementById(text_id).value= select.options[select.selectedIndex].text;
    // let test = select.options[select.selectedIndex].text
    // console.log(test);
}

// Upload file feedback

// Xử lý ajax upload nhiều ảnh 
$(document).ready(function () {
    $('#img_feedback').on('change', function(){
        var upImg = this;
        var formData = new FormData();
        var file, len = upImg.files.length;
        for(var i = 0; i < len; i++) {
            file = upImg.files[i];
            formData.append("img_feedback[]", file);
        }
        var ajax = new XMLHttpRequest();
        ajax.onreadystatechange = function() {
            if(ajax.status == 200 && ajax.readyState == 4) {
                console.log(ajax.responseText);
                if(ajax.responseText == 0) {
                    toastr['error']('Upload images fail!');
                }
                else if(ajax.responseText == 'qty') {
                    toastr['error']('Upload images fail!');
                }
                else {
                    // res trả về tag img html có src link tới thư mục upload
                    var res = ajax.responseText;
                    $('.view_feedback').append(res)
                }
            }
        }
        ajax.open("POST", './Servers/upload.php', true);
        ajax.send(formData)
    })
})