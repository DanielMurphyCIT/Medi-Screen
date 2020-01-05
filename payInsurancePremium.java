package com.example.mediscreen;

import androidx.appcompat.app.AppCompatActivity;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.example.mediscreen.Config.Config;
import com.paypal.android.sdk.payments.PayPalConfiguration;
import com.paypal.android.sdk.payments.PayPalPayment;
import com.paypal.android.sdk.payments.PayPalService;
import com.paypal.android.sdk.payments.PaymentActivity;
import com.paypal.android.sdk.payments.PaymentConfirmation;

import org.json.JSONException;

import java.math.BigDecimal;

public class payInsurancePremium extends AppCompatActivity {

    public static final int PAPAL_REQUEST_CODE = 7171;

    private static PayPalConfiguration config = new PayPalConfiguration()
            .environment(PayPalConfiguration.ENVIRONMENT_SANDBOX)
            .clientId(Config.PAYPAL_CLIENT_ID);

    Button payNowBtn;
    EditText editAmount;
    String amount = "";

    @Override
    protected void onDestroy() {
        stopService(new Intent(this, PayPalService.class));
        super.onDestroy();

    }

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_pay_insurance_premium);

        Intent intent = new Intent(this, PayPalService.class);
        intent.putExtra(PayPalService.EXTRA_PAYPAL_CONFIGURATION, config);
        startService(intent);

        payNowBtn = (Button) findViewById(R.id.payNowBtn);
        editAmount = (EditText) findViewById(R.id.editAmount);

        payNowBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                processPayment();

            }
        });
    }

    private void processPayment() {
        amount = editAmount.getText().toString();
        PayPalPayment payPalPayment = new PayPalPayment(new BigDecimal(String.valueOf(amount)), "EUR",
                "Pay your Premium", PayPalPayment.PAYMENT_INTENT_SALE);

        Intent intent = new Intent(this, PaymentActivity.class);

        intent.putExtra(PayPalService.EXTRA_PAYPAL_CONFIGURATION, config);
        intent.putExtra(PaymentActivity.EXTRA_PAYMENT, payPalPayment);

        startActivityForResult(intent, PAPAL_REQUEST_CODE);

    }


    protected void OnActivityResult(int requestCode, int resultCode, Intent data) {
       if (requestCode == PAPAL_REQUEST_CODE)
       {
           if (resultCode == RESULT_OK) {
               PaymentConfirmation confirmation = data.getParcelableExtra(PaymentActivity.EXTRA_RESULT_CONFIRMATION);
               if (confirmation != null)
               {
                   try {
                       String paymentDetails = confirmation.toJSONObject().toString(4);

                       startActivity(new Intent(this, PaymentDetails.class)
                               .putExtra("PaymentDetails", paymentDetails)
                               .putExtra("PaymentAmount", amount)

                       );

                   } catch (JSONException e) {
                       e.printStackTrace();
               }
               }
           }
           else if (resultCode == Activity.RESULT_CANCELED)
               Toast.makeText(this, "Cancel", Toast.LENGTH_SHORT).show();
       }
       else if (resultCode == PaymentActivity.RESULT_EXTRAS_INVALID)
           Toast.makeText(this, "Invalid", Toast.LENGTH_SHORT).show();
    }


}
