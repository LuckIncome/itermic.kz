$(document).ready(function() {

    $( "#datepicker" ).datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd',
        yearRange: "2000:",
        monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
        monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн','Июл','Авг','Сен','Окт','Ноя','Дек'],
        dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
        dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
        dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
    });

    $('body').on('click', '.remove--organizations', function(e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        var section = $(this).attr('data-section');

        $.ajax({
            url: '/admin/settings/sections/' + section + '/organizations/' + id,
            type: 'DELETE',
            dataType: 'json',
            data : { _token: $('meta[name="_token"]').attr('content')},
            success: function(data) {
                if (data.success) {
                    $("#organizations--item-" + id).remove();
                    messageSuccess(data.success);
                } else {
                    messageError(data.errors);
                }
            }
        });
    });


    var myMap;

// Дождёмся загрузки API и готовности DOM.
    ymaps.ready(init);

    function init () {
        // Создание экземпляра карты и его привязка к контейнеру с
        // заданным id ("map").
        myMap = new ymaps.Map('map', {
            // При инициализации карты обязательно нужно указать
            // её центр и коэффициент масштабирования.
            center:[51.14993896, 71.42633800], // Нур-Султан
            zoom:12
        }),

            $("#coordinate").val('51.14993896, 71.42633800');

            myGeoObject = new ymaps.GeoObject({
                // Описание геометрии.
                geometry: {
                    type: "Point",
                    coordinates: [51.14993896, 71.42633800]
                },
            }, {
                // Опции.
                // Иконка метки будет растягиваться под размер ее содержимого.
                preset: 'twirl#redStretchyIcon',
                // Метку можно перемещать.
                draggable: true
            });

        myMap.geoObjects.add(myGeoObject);

        myGeoObject.events.add('drag', function(events){
            $("#coordinate").val(myGeoObject.geometry.getCoordinates()[0] +', '+ myGeoObject.geometry.getCoordinates()[1]);
        });


    }

});
