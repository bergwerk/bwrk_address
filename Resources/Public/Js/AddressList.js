$(document).ready(function () {

    $('.tx-bwrkaddress .address-list').each(function () {
        var list = $(this);

        var addressList = new AddressList();
            addressList.initialize(list);
    });
});

var AddressList = function () {
    this._addressWrapper = null;
    this._addressListItems = null;
};

AddressList.prototype.initialize = function (list) {
    this._addressWrapper = list;
    this._addressListItems = this._addressWrapper.find('.address-item');
    this.updateHeight();
};

AddressList.prototype.updateHeight = function () {
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