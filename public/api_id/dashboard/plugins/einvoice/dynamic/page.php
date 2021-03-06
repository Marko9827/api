<?php



?>
<div class="invoice-box">


    <table cellpadding="0" cellspacing="0">
        <tr class="top">
            <td colspan="4">
                <table>
                    <tr>
                        <td class="title">
                            <img src="/?sourcedash=logo.svg" style="width:100%;/* max-width:300px;*/">
                            <input type="file" id="invoice_img" />
                            <span>Recommended size: 1500 / 2</span>
                        </td>

                        <td>
                            <input style="text-align: right;" placeholder="Invoice #: 123"><br> Created: <?php echo date("Y/m/d"); ?><br><input style="text-align: right;" placeholder="Due: example <?php echo date("Y/m/d"); ?>" /> </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class=" information">
            <td colspan="4">
                <table id="information_table_4">
                    <tr>
                        <td>
                            <input placeholder="Example, Inc." /><br>
                            <input placeholder="12345 Example Road" /><br>
                            <input placeholder="Example, CA 12345" /><br>
                        </td>

                        <td id="info-head-right">
                            <input placeholder="Example Corp." /><br>
                            <input placeholder="Example name" /><br>
                            <input type="email" placeholder="inf@example.com" /><br>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="heading">
            <td colspan="3">
                Payment Method
            </td>

            <td>
                Check #
            </td>
        </tr>

        <tr class="details">
            <td colspan="3">
                <input value="Check" />
            </td>

            <td>
                <input type="number" style="text-align: right;" max="4" maxlength="4" placeholder="1000" />
            </td>
        </tr>

        <tr class=" heading">
            <td>
                Item
            </td>

            <td>
                Unit Cost
            </td>

            <td>
                Quantity
            </td>

            <td>
                Price
            </td>
        </tr>

        <tr class="item">
            <td>
                <input value="Website design" placeholder="Item name" />
            </td>

            <td>
                $<input type="number" placeholder="Cost" value="300" />
            </td>

            <td>
                <input type="number" value="1" placeholder="Quantity" />
            </td>

            <td>
                $300.00
            </td>
        </tr>



        <tr>
            <td colspan="4">
                <button class="btn-add-row btn btn-primary ">Add row</button>
                <button style="margin-left: 5px;" class="btn-remove-row btn btn-danger ">Remove last row</button>
                <button style="margin-left: 5px;" class="btn btn-info" onclick="window.print()"><i class="far fa-file-pdf"></i> Download</button>
            </td>
        </tr>

        <tr class="total">
            <td colspan="3"></td>

            <td>
                Total: $385.00
            </td>
        </tr>
    </table> <?php

  

                ?>
</div>