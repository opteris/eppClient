/**
 * Created by aasiimwe on 11/24/2015.
 */

var responsiveTables = {
    init: function() {
        $(document).find('.fixed-columns').each(function (i, elem) {
            responsiveTables.fixColumns(elem);
        });
    },

    fixColumns: function(table, columns) {
        var $table = $(table);
        $table.removeClass('fixed-columns');
        var $fixedColumns = $table.clone().attr('id', $table.attr('id') + '-fixed').insertBefore($table).addClass('fixed-columns-fixed');

        $fixedColumns.find('*').each(function (i, elem) {
            if ($(this).attr('id') !== undefined) {
                $table.find("[id='" + $(this).attr("id") + "']").attr('id', $(this).attr('id') + '-hidden');
            }
            if ($(this).attr('name') !== undefined) {
                $table.find("[name='" + $(this).attr("name") + "']").attr('name', $(this).attr('name') + '-hidden');
            }
        });

        if (columns !== undefined) {
            $fixedColumns.find('tr').each(function (x, elem) {
                $(elem).find('th,td').each(function (i, elem) {
                    if (i >= columns) {
                        $(elem).remove();
                    }
                });
            });
        } else {
            $fixedColumns.find('tr').each(function (x, elem) {
                $(elem).find('th,td').each(function (i, elem) {
                    if (!$(elem).hasClass('fixed-column')) {
                        $(elem).remove();
                    }
                });
            });
        }

        $fixedColumns.find('tr').each(function (i, elem) {
            $(this).height($table.find('tr:eq(' + i + ')').height());
        });
    }
};

responsiveTables.init();