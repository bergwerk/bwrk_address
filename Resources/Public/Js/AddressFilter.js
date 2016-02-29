$(document).ready(function () {

    $('.tx-bwrkaddress .address-filter').each(function () {
        var filterNavigation = $(this);

        var addressFilter = new AddressFilter();
            addressFilter.initialize(filterNavigation);
    });
});

var AddressFilter = function () {
    this._activeClass = 'active';
    this._filter = null;
    this._filterListItems = null;
    this._addressWrapper = null;
    this._addressListItems = null;
};

AddressFilter.prototype.initialize = function (filterNavigation) {
    this._filter = filterNavigation;
    this._filterListItems = filterNavigation.find('li');
    this._addressWrapper = $(this._filter.attr('data-target'));
    this._addressListItems = this._addressWrapper.find('.address-item');

    var that = this;

    this._filter.find('a').click(function () {
        return that.filterClick(
            $(this)
        );
    });

    this.updateHeight();
};

AddressFilter.prototype.filterClick = function (link) {
    var listItem = link.parents('li');
    var categoryUid = parseInt(listItem.attr('data-category-uid'));

    this._filterListItems.removeClass(this._activeClass);
    listItem.addClass(this._activeClass);

    this._addressListItems.each(function () {
        var address = $(this);
        var categoryUids = JSON.parse(address.attr('data-category-uids'));

        if ($.inArray(categoryUid, categoryUids) >= 0 || categoryUid <= 0)
        {
            address.show();
        }
        else
        {
            address.hide();
        }
    });

    return false;
};

AddressFilter.prototype.updateHeight = function () {
    var height = 0;

    this._addressListItems.each(function () {
        var address = $(this);
        var addressHeight = address.outerHeight();

        if (addressHeight > height)
        {
            height = addressHeight;
        }
    });

    this._addressListItems.height(height);
};