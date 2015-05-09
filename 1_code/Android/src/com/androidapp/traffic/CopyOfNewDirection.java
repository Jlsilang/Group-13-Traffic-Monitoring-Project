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
import java.util.concurrent.ExecutionException;

import javax.xml.parsers.SAXParserFactory;

import android.app.ProgressDialog;
import android.content.Intent;
import android.location.Criteria;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentActivity;
import android.util.Log;
import android.view.Menu;
import android.view.View;
import android.view.View.OnClickListener;
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

public class CopyOfNewDirection extends FragmentActivity implements LocationListener {
		// Progress Dialog
		private ProgressDialog pDialog;

		// Creating JSON Parser object
	GoogleMap googleMap;
	Spinner sp1;
	Spinner sp2;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.map_activity);

		init();
		sp1 = (Spinner) findViewById(R.id.spinner1);
		sp2 = (Spinner) findViewById(R.id.spinner2);
		// Getting reference to the SupportMapFragment of activity_main.xml
		SupportMapFragment fm = (SupportMapFragment) getSupportFragmentManager().findFragmentById(R.id.map);
		
		// Getting GoogleMap object from the fragment
		googleMap = fm.getMap();
		
		// Enabling MyLocation Layer of Google Map
		googleMap.setMyLocationEnabled(true);				
				
		
		 // Getting LocationManager object from System Service LOCATION_SERVICE
        LocationManager locationManager = (LocationManager) getSystemService(LOCATION_SERVICE);

        // Creating a criteria object to retrieve provider
        Criteria criteria = new Criteria();

        // Getting the name of the best provider
        String provider = locationManager.getBestProvider(criteria, true);

        // Getting Current Location
        Location location = locationManager.getLastKnownLocation(provider);

        if(location!=null){
                onLocationChanged(location);
        }

        locationManager.requestLocationUpdates(provider, 20000, 0, this);
		
        Button getReportButton = (Button) findViewById(R.id.trafficreportbutton);
        Button reportTraffic = (Button) findViewById(R.id.submittrafficreport);
        
        
        getReportButton.setOnClickListener(new OnClickListener()
        { 
        public void onClick(View v) 
        {    	
        	Intent it = new Intent(CopyOfNewDirection.this,Report.class);
            startActivity(it);     
              
        }
            
        });
        
        reportTraffic.setOnClickListener(new OnClickListener()
        { 
        public void onClick(View v) 
        {    	
        	Intent it = new Intent(CopyOfNewDirection.this,Submit.class);
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
	

	@Override
	public void onLocationChanged(Location location) {
		
		
		// Getting latitude of the current location
		double latitude = location.getLatitude();
		
		// Getting longitude of the current location
		double longitude = location.getLongitude();		
		
		// Creating a LatLng object for the current location
		LatLng latLng = new LatLng(latitude, longitude);
		
		// Showing the current location in Google Map
		googleMap.moveCamera(CameraUpdateFactory.newLatLng(latLng));
		
		// Zoom in the Google Map
		googleMap.animateCamera(CameraUpdateFactory.zoomTo(15));
		
		// Setting latitude and longitude in the TextView tv_location
	//	tvLocation.setText("Latitude:" +  latitude  + ", Longitude:"+ longitude );		
				
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
	
	private void init(){

		RetrieveFeedTask bluh=new RetrieveFeedTask();
		 AsyncTask<String, Void, String> eyo=bluh.execute("");
		 try {
			 System.out.println(eyo.get());
			Toast.makeText(this, eyo.get(), Toast.LENGTH_LONG).show();
		} catch (InterruptedException e) {
			// TODO Auto-generated catch block
			Toast.makeText(this, "bad1", Toast.LENGTH_SHORT).show();

			//e.printStackTrace();
		} catch (ExecutionException e) {
			// TODO Auto-generated catch block
			Toast.makeText(this, "bad2", Toast.LENGTH_SHORT).show();

		}
	}
	
	class RetrieveFeedTask extends AsyncTask<String, Void, String> {

	    private Exception exception;

	    protected String doInBackground(String... urls) {
	    	
	    	
	    	try {
                retrieveAndAddCities();
            } catch (IOException e) {
                Log.e("welp", "Cannot retrive cities", e);
            }
	    	
	    	
			DefaultHttpClient httpclient = new DefaultHttpClient();
	        HttpPost httppost = new HttpPost("http://justincoding.com/trafficProject/index.php?region=c&road=0&day=all&weather=all&submit=View+Statistics");

	     //   Log.d("newdirection", "Hello!");
	            try {
	                HttpResponse response = httpclient.execute(httppost);
	                
	                HttpEntity entity = response.getEntity();
	                String htmlResponse = EntityUtils.toString(entity);
	                
//	                BufferedReader in = new BufferedReader
//	                		(new InputStreamReader(entity.getContent()));
	               Log.d("newdirection","hi");
	               Log.d("newdirection", htmlResponse);
	                
	         //       Toast.makeText(NewDirection.this, "hi!"+htmlResponse, Toast.LENGTH_SHORT).show();
	               StringBuffer sb = new StringBuffer("");
	               String line="";
//	               while ((line = in.readLine()) != null) {
//	                  sb.append(line);
//	                  break;
//	                }
//	                in.close();
//	                Log.d("newdirection",sb.toString());
//	                return sb.toString(); 
	                return htmlResponse;
	             } catch (ClientProtocolException e) {
	                // TODO Auto-generated catch block
	            	//System.out.println("hi");
	        //        Toast.makeText(NewDirection.this, "bad 1", Toast.LENGTH_SHORT).show();
	            } catch (IOException e) {
	                // TODO Auto-generated catch block
	      //          Toast.makeText(NewDirection.this, "bad 2", Toast.LENGTH_SHORT).show();

	            }
	            return null;
	    }

	    protected void onPostExecute(String feed) {
	        // TODO: check this.exception 
	        // TODO: do something with the feed
	    }
	    
	    protected void retrieveAndAddCities() throws IOException {
	        HttpURLConnection conn = null;
	        final StringBuilder json = new StringBuilder();
	        try {
	            // Connect to the web service
	            URL url = new URL("http://justincoding.com/trafficProject/index.php?region=c&road=0&day=all&weather=all&submit=View+Statistics");
	            conn = (HttpURLConnection) url.openConnection();
	            InputStreamReader in = new InputStreamReader(conn.getInputStream());
	 
	            // Read the JSON data into the StringBuilder
	            int read;
	            char[] buff = new char[1024];
	            while ((read = in.read(buff)) != -1) {
	                json.append(buff, 0, read);
	            }
	        } catch (IOException e) {
	            Log.e("welp", "Error connecting to service");
	            //throw new IOException("Error connecting to service", e);
	        } finally {
	            if (conn != null) {
	                conn.disconnect();
	            }
	        }
	 
	        // Create markers for the city data.
	        // Must run this on the UI thread since it's a UI operation.
	        runOnUiThread(new Runnable() {
	            public void run() {
	                try {
	                    createMarkersFromJson(json.toString());
	                } catch (JSONException e) {
	                    Log.e("welp", "Error processing JSON", e);
	                }
	            }
	        });
	    }
	    
	    void createMarkersFromJson(String json) throws JSONException {
	        // De-serialize the JSON string into an array of city objects
	        JSONArray jsonArray = new JSONArray(json);
	        for (int i = 0; i < jsonArray.length(); i++) {
	            // Create a marker for each city in the JSON data.
	            JSONObject jsonObj = jsonArray.getJSONObject(i);
	            googleMap.addMarker(new MarkerOptions()
	                .title(jsonObj.getString("name"))
	                .snippet(Integer.toString(jsonObj.getInt("population")))
	                .position(new LatLng(
	                        jsonObj.getJSONArray("latlng").getDouble(0),
	                        jsonObj.getJSONArray("latlng").getDouble(1)
	                 ))
	            );
	        }
	    }
	}
	
}
