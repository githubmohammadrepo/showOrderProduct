if (name == null) {
    //name does not chanaged
    if (count == null) {
        // count is null
        if (price == null) {
            // oldData and New Data is equal
            // just close modal
            jQuery('#myModal').modal('close');
        } else {
            let priceValue = price.value;
            // check if prive equal to old price
            if (oldRowData.price == priceValue) {
                //field does not changes just close the dialog
                jQuery('#myModal').modal('close');
            } else {
                //save data
                saveData()
            }

        }
    } else {
        let countValue = count.value;
        if (oldRowData.count == countValue) {
            if (price == null) {
                // oldData and New Data is equal
                // just close modal
                jQuery('#myModal').modal('close');
            } else {
                let priceValue = price.value;
                // check if prive equal to old price
                if (oldRowData.price == priceValue) {
                    //field does not changes just close the dialog
                    jQuery('#myModal').modal('close');
                } else {
                    //save data
                    saveData()
                }

            }
        } else {
            //save data
            saveData()
        }

    }
} else {
    let nameValue = name.value;
    if (oldRowData.name == nameValue) {
        if (count == null) {
            if (price == null) {
                // oldData and New Data is equal
                //check is name equal to old name
                if (oldRowData.name == nameValue) {
                    //two row is equal no need to get any thing just close dialog
                    jQuery('#myModal').modal('close');

                } else {
                    //save Data
                }
            } else {
                let priceValue = price.value;
                // save data

            }
        } else {
            let countValue = count.value;
            if (oldRowData.count == countValue) {
                if (price == null) {
                    // oldData and New Data is equal
                    // just close modal
                    jQuery('#myModal').modal('close');
                } else {
                    let priceValue = price.value;
                    // check if prive equal to old price
                    if (oldRowData.price == priceValue) {
                        //field does not changes just close the dialog
                        jQuery('#myModal').modal('close');
                    } else {
                        //save data
                        saveData()
                    }

                }
            } else {
                //save data
                saveData()
            }

        }

    } else {
        //save data
        saveData()
    }
}