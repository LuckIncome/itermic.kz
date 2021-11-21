$(document).ready(function () {
    $("#datepicker").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd',
        yearRange: "2000:",
        monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
        monthNamesShort: ['Янв', 'Фев', 'Мар', 'Апр', 'Май', 'Июн', 'Июл', 'Авг', 'Сен', 'Окт', 'Ноя', 'Дек'],
        dayNames: ['воскресенье', 'понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота'],
        dayNamesShort: ['вск', 'пнд', 'втр', 'срд', 'чтв', 'птн', 'сбт'],
        dayNamesMin: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
    });

    // Дождёмся загрузки API и готовности DOM.
    ymaps.ready(init);

    function init() {
        var coord = $("#coordinate").val();

        if (coord === '') {
            coord = [51.14993896, 71.42633800];
        } else {
            coord = $("#coordinate").val().split(', ');
        }

        // Создание экземпляра карты и его привязка к контейнеру с
        // заданным id ("map").
        var myMap = new ymaps.Map('map', {
            // При инициализации карты обязательно нужно указать
            // её центр и коэффициент масштабирования.
            center: coord, // Нур-Султан
            zoom: 14
        });

        $("#coordinate").val(coord.join(', '));

        var myGeoObject = new ymaps.GeoObject({
            // Описание геометрии.
            geometry: {
                type: "Point",
                coordinates: coord
            },
        }, {
            // Опции.
            // Иконка метки будет растягиваться под размер ее содержимого.
            preset: 'twirl#redStretchyIcon',
            // Метку можно перемещать.
            draggable: true
        });

        myMap.geoObjects.add(myGeoObject);

        myGeoObject.events.add('drag', function (events) {
            $("#coordinate").val(myGeoObject.geometry.getCoordinates()[0] + ', ' + myGeoObject.geometry.getCoordinates()[1]);
        });

    }

});
