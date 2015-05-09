package com.androidapp.traffic;

import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.client.ClientProtocolException;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.util.EntityUtils;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;
import java.util.List;
import java.util.Locale;
import java.util.concurrent.ExecutionException;

import javax.xml.parsers.SAXParserFactory;

import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.location.Address;
import android.location.Criteria;
import android.location.Geocoder;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.os.AsyncTask;
import android.os.Bundle;
import android.speech.RecognizerIntent;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentActivity;
import android.util.Log;
import android.view.Menu;
import android.view.View;
import android.view.View.OnClickListener;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

import com.google.android.gms.maps.CameraUpdateFactory;
import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.SupportMapFragment;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.MarkerOptions;

public class NewDirection extends FragmentActivity implements LocationListener {
	
	double latitude;
	double longitude;
	String address;
	String zipcode;
	String state;
	String zip;
	String street;
	LocationManager locationManager;
	Location location;
	String currentLocation;
	String provider;
	String javascript;
	boolean tryingtoload=false;
	boolean initload=true;
		// Progress Dialog
		private ProgressDialog pDialog;

		// Creating JSON Parser object
	//GoogleMap googleMap;
	Spinner sp1;
	
	Spinner sp2;
	   private WebView browser;
	  String endaddress;
	   
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.map_activity);

		 Bundle b = new Bundle();
		    b = getIntent().getExtras();
		    endaddress = b.getString("address");
		
		sp1 = (Spinner) findViewById(R.id.spinner1);
		sp2 = (Spinner) findViewById(R.id.spinner2);
		// Getting reference to the SupportMapFragment of activity_main.xml		
		
		 // Getting LocationManager object from System Service LOCATION_SERVICE
         locationManager = (LocationManager) getSystemService(LOCATION_SERVICE);

        // Creating a criteria object to retrieve provider
        Criteria criteria = new Criteria();

        // Getting the name of the best provider
        provider = locationManager.getBestProvider(criteria, true);

        // Getting Current Location
        location = locationManager.getLastKnownLocation(provider);


        if(location!=null){
            onLocationChanged(location);
    }
      

        locationManager.requestLocationUpdates(provider, 20000, 0, this);
		

        updateLocationString();

        
        
        browser = (WebView)findViewById(R.id.webView1);
        browser.setWebViewClient(new MyBrowser());
	      String url = "http://m.justincoding.com/trafficProject/Fast.php";
	      browser.getSettings().setLoadsImagesAutomatically(true);
	      browser.getSettings().setJavaScriptEnabled(true);
	      browser.setScrollBarStyle(View.SCROLLBARS_INSIDE_OVERLAY);
	      browser.loadUrl(url);    


	      tryingtoload=true;

	      //browser.loadUrl(url);    

        Button getReportButton = (Button) findViewById(R.id.trafficreportbutton);
        Button reportTraffic = (Button) findViewById(R.id.submittrafficreport);
        
        
        
        
        getReportButton.setOnClickListener(new OnClickListener()
        { 
        public void onClick(View v) 
        {    	
        	Intent it = new Intent(NewDirection.this,Report.class);
            startActivity(it);     
              
        }
            
        });
        
        reportTraffic.setOnClickListener(new OnClickListener()
        { 
        public void onClick(View v) 
        {    	
        	Intent it = new Intent(NewDirection.this,Submit.class);
            startActivity(it);     
              
        }
            
        });
        
        ArrayAdapter<CharSequence> adapter = ArrayAdapter.createFromResource(this,
				R.array.timearray, android.R.layout.simple_spinner_item);
		adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
		sp1.setAdapter(adapter);


		ArrayAdapter<CharSequence> adapter2 = ArrayAdapter.createFromResource(this,
				R.array.weatherarray, android.R.layout.simple_spinner_item);
		adapter2.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
		sp2.setAdapter(adapter2);
        
	}
	
	
//	@Override
//	public void onClick(View v) {
//	Intent i = new Intent(RecognizerIntent.ACTION_RECOGNIZE_SPEECH);
//	         i.putExtra(RecognizerIntent.EXTRA_LANGUAGE_MODEL, "en-US");
//	        	 try {
//	             startActivityForResult(i, REQUEST_OK);
//	         } catch (Exception e) {
//	        	 	Toast.makeText(this, "Error initializing speech to text engine.", Toast.LENGTH_LONG).show();
//	         }
//	}
//
//	5.  When the intent calls back, we display the transcribed text.
//
//	@Override
//	protected void onActivityResult(int requestCode, int resultCode, Intent data) {
//	        super.onActivityResult(requestCode, resultCode, data);
//	        if (requestCode==REQUEST_OK  && resultCode==RESULT_OK) {
//	        		ArrayList<String> thingsYouSaid = data.getStringArrayListExtra(RecognizerIntent.EXTRA_RESULTS);
//	        		((TextView)findViewById(R.id.text1)).setText(thingsYouSaid.get(0));
//	        }
//	    }
	

	   private class MyBrowser extends WebViewClient {
	      @Override
	      public boolean shouldOverrideUrlLoading(WebView view, String url) {
	         view.loadUrl(url);
	         return true;
	      }
	      
			@Override
	        public void onPageFinished(WebView view, String url) {
				if(tryingtoload){
				      javascript="javascript: (function(){"
								+"document.getElementById('startingAddress').value='"
								+ latitude+", "+longitude
								+ "';"
								+"document.getElementById('destinationAddress').value='"
								+ endaddress
								+ "';"
								+ "calcRoute();"
								+ "})()";
				    view.loadUrl(javascript);
					tryingtoload=false;
					initload=false;
				}
	        }
			
			 
	   }
	
	
	@Override
	public void onLocationChanged(Location location) {
		
		
		// Getting latitude of the current location
		latitude = location.getLatitude();
		
		// Getting longitude of the current location
		longitude = location.getLongitude();		
		
		// Creating a LatLng object for the current location
		LatLng latLng = new LatLng(latitude, longitude);
	      javascript="javascript: (function(){"
					+"document.getElementById('startingAddress').value='"
					+ latitude+", "+longitude
					+ "';"
					+"document.getElementById('destinationAddress').value='"
					+ endaddress
					+ "';"
					+ "calcRoute();"
					+ "})()";
	      if(!initload)
	    	  browser.loadUrl(javascript);		
		// Showing the current location in Google Map
		//googleMap.moveCamera(CameraUpdateFactory.newLatLng(latLng));
		
		// Zoom in the Google Map
		//googleMap.animateCamera(CameraUpdateFactory.zoomTo(15));
		
		// Setting latitude and longitude in the TextView tv_location
	//	tvLocation.setText("Latitude:" +  latitude  + ", Longitude:"+ longitude );	
		updateLocationString();
				
	}

	@Override
	public void onProviderDisabled(String provider) {
		// TODO Auto-generated method stub		
	}

	@Override
	public void onProviderEnabled(String provider) {
		// TODO Auto-generated method stub		
	}

	@Override
	public void onStatusChanged(String provider, int status, Bundle extras) {
		// TODO Auto-generated method stub		
	}
	
	@Override
	public boolean onCreateOptionsMenu(Menu menu) {
		// Inflate the menu; this adds items to the action bar if it is present.
		getMenuInflater().inflate(R.menu.activity_main, menu);
		return true;
	}
	
	private void updateLocationString(){
    	Geocoder geocoder = new Geocoder(this, Locale.ENGLISH);
		try {
			List<Address> addresses = geocoder.getFromLocation(latitude, longitude, 1);

			if ((addresses != null) & (addresses.size() > 0)) {
				Address returnedAddress = addresses.get(0);
				StringBuilder strReturnedAddress = new StringBuilder(
						"Address:\n");
				for (int i = 0; i < returnedAddress.getMaxAddressLineIndex(); i++) {
					strReturnedAddress
							.append(returnedAddress.getAddressLine(i)).append(
									"\n");
				}
				address=strReturnedAddress.toString();
				currentLocation=strReturnedAddress.toString();
				String parse = strReturnedAddress.toString();
				int end = parse.length() - 1;
				zipcode = parse.substring(end - 5, end);
				state = parse.substring(end-8,end-6);
				int t1 = parse.indexOf("\n",0);
				int t2 = parse.indexOf("\n",t1+1);
				street = parse.substring(t1+1,t2);
				//zip.setText(zipcode);
			} else {
				//address.setText("No Address returned!");
			}
		} catch (IOException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
			//address.setText("Cannot get Address!");
		}

	}

	
}
