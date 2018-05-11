<script type="text/javascript" >
    _create: function () {
        var self = this;
        this._dateFormat = this.options.dateFormat || $.datepicker._defaults.dateFormat;
        var date = this._initialDate();
        this._setWeek(date);
        var onSelect = this.options.onSelect;
        this._picker = $(this.element).datepicker($.extend(this.options, this._weekOptions, {
            onSelect: function (dateText, inst) {
                self._select(dateText, inst, onSelect);
            },
            beforeShowDay: function (date) {
                return self._showDay(date);
            },
            onChangeMonthYear: function (year, month, inst) {
                self._selectCurrentWeek();
            }
        }));
        this._picker.datepicker('setDate', date);
    }

    _initialDate: function () {
        if (this.options.currentText) {
            return $.datepicker.parseDate(this._dateFormat, this.options.currentText);
        } else {
            return new Date;
        }
    }
    _setWeek: function (date) {
        var year = date.getFullYear(),
                month = date.getMonth(),
                day = date.getDate() - date.getDay();
        this._startDate = new Date(year, month, day);
        this._endDate = new Date(year, month, day + 6);
    }
    _select: function (dateText, inst, onSelect) {
        this._setWeek(this._picker.datepicker('getDate'));
        var startDateText = $.datepicker.formatDate(this._dateFormat, this._startDate, inst.settings);
        this._picker.val(startDateText);
        if (onSelect)
            onSelect(dateText, startDateText, this._startDate, this._endDate, inst);
    }
    _showDay: function (date) {
        var cssClass = date >= this._startDate && date <= this._endDate ? 'ui-datepicker-current-day' : '';
        return [true, cssClass];
    }
    _selectCurrentWeek: function () {
        $('.ui-datepicker-calendar').find('.ui-datepicker-current-day a').addClass('ui-state-active');
    }
    _weekOptions: {
        showOtherMonths:   true,
                selectOtherMonths: true
    }
    $(document).on('mousemove', '.ui-datepicker-calendar tr', function () {
                $(this).find('td a').addClass('ui-state-hover');
            }).on('mouseleave', '.ui-datepicker-calendar tr', function () {
                $(this).find('td a').removeClass('ui-state-hover');
            });



</script>
<style>
    .ui-datepicker {
        border-radius: 0;
        padding: 0 0 1.5em;
        border: 0;
        box-shadow: 2px 2px 5px #aaa;
        width: 14.5em;
    }

    .ui-datepicker table {
        font-size: 13px;
    }

    .ui-datepicker th,
    .ui-datepicker td {
        padding: 0;
        width: 10px;
    }

    .ui-datepicker th {
        text-transform: uppercase;
        color: #E3797D;
        font-size: .8em;
        padding-bottom: 1em;
    }

    .ui-datepicker .ui-datepicker-header {
        border: none;
        border-radius: 0;
        background: #4ECDC4;
        color: #fff;
        margin-bottom: 2em;
    }

    .ui-datepicker .ui-datepicker-title {
        line-height: 1;
        padding: 3em 0;
        font-family: 'Oswald', sans-serif;
        text-transform: uppercase;
    }

    .ui-datepicker .ui-datepicker-month {
        display: block;
        font-size: 1.8em;
        margin-bottom: .4em;
    }

    .ui-datepicker .ui-datepicker-year {
        color: rgba(255, 255, 255, 0.7);
    }

    .ui-datepicker .ui-datepicker-prev,
    .ui-datepicker .ui-datepicker-next {
        top: 50%;
        margin-top: -16px;
        border: 0;
        cursor: pointer;
    }

    .ui-datepicker .ui-datepicker-prev {
        left: 10px;
    }

    .ui-datepicker .ui-datepicker-next {
        right: 10px;
    }

    .ui-datepicker .ui-datepicker-prev .ui-icon {
        background-position: -96px -32px;
    }

    .ui-datepicker .ui-datepicker-prev:hover .ui-icon {
        background-position: -96px -48px;
    }

    .ui-datepicker .ui-datepicker-next .ui-icon {
        background-position: -32px -32px;
    }

    .ui-datepicker .ui-datepicker-next:hover .ui-icon {
        background-position: -32px -48px;
    }

    .ui-datepicker .ui-state-default {
        border: none;
        background: transparent;
        padding: 0;
        height: 30px;
        line-height: 30px;
        text-align: center;
    }

    .ui-datepicker td.ui-datepicker-current-day .ui-state-default,
    .ui-datepicker .ui-state-hover {
        background: #4ECDC4;
        color: #fff;
    }

    .ui-datepicker .ui-priority-secondary,
    .ui-datepicker .ui-widget-content .ui-priority-secondary,
    .ui-datepicker .ui-widget-header .ui-priority-secondary {
        opacity: .4;
        filter: Alpha(Opacity=40);
    }

</style>