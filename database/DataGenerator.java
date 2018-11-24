import java.io.*;
import java.util.*;
import java.sql.Timestamp;
import java.text.SimpleDateFormat;
import java.math.BigInteger;
import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;

public class DataGenerator{
    public static String getMd5(String input){
        try{
        MessageDigest md = MessageDigest.getInstance("MD5");
        byte[] messageDigest = md.digest(input.getBytes());
        BigInteger no = new BigInteger(1, messageDigest);
        String hashtext = no.toString(16);
        while (hashtext.length() < 32)
            hashtext = "0" + hashtext;
        return hashtext;
        } catch (NoSuchAlgorithmException e) {
            throw new RuntimeException(e);
        }
    }
    
    // assume the purchasing events follow Possion disubtion
    // the time inverals between two events follow exp distribution
    public static double getNext() {
        double lambda = 0.000035;
        return  Math.log(1-Math.random())/(-lambda);
    }
    
    public static void main(String[] args) throws Exception{
        // parse address
        FileInputStream fis =new FileInputStream("addresses.csv");
        BufferedReader in=new BufferedReader(new InputStreamReader(fis));
        String line = in.readLine(); // skip table header
        int MAX_ADD=3200;
        int MAX_ORDER = 10;
        int MAX_PROD = 25;
        int MAX_CUST = 100;
        int MAX_QTY = 10;
        int MAX_NAME = 1000;
        int MAX_EMPOL = 10;
        
        int sNum = 100; // number of stores
        int s_base = 30; // starting store id
        int eid = 80000; // starting empolyee id
        int cNum = 500;  // number of customers
        int c_base = 1000; // starting customer id
        int oNum = 1000;    // number of orders
        
        String street = "292 Elm Ct";
        String city = "Pittsburgh";
        String state = "PA";
        String zip = "15237";
        
        String adds[][]=new String[MAX_ADD][5];
        for(int i=0;i<MAX_ADD;i++){
            line=in.readLine();
            StringTokenizer st=new StringTokenizer(line, ",");
            for(int j=0;j<5;j++)
                adds[i][j]=st.nextToken();
            //System.out.println(adds[i][0]+ ", "+adds[i][2]+", "+adds[i][3]+", "+adds[i][4]);
        }
        
        // prease names
        FileInputStream fis2 =new FileInputStream("names.txt");
        BufferedReader in2=new BufferedReader(new InputStreamReader(fis2));
        
        String names[][] = new String[MAX_NAME][2];
        for(int i=0;i<MAX_NAME;i++){
            line=in2.readLine();
            StringTokenizer st=new StringTokenizer(line, " ");
            names[i][0]=st.nextToken();
            names[i][1]=st.nextToken();
        }
        
        
        
        ////////////
        // store //
        ///////////
        System.out.println();
        System.out.println();
        
        int [] enums = new int[sNum];
        String [] zips= new String [sNum];
        
        System.out.println("INSERT INTO `stores` (`store_id`, `phone_number`, `no_of_employees`, `street`, `city`, `state`, `zip`) VALUES");

        for (int i=0;i<sNum;i++){
            long phone = (long)(Math.random() * 8999999999L + 1000000000L);
            int noe = (int)(Math.random() * 8 + 2);
            int rndAdd = (int)(Math.random() * MAX_ADD);
            
            street = adds[rndAdd][0];
            city = adds[rndAdd][2];
            state = adds[rndAdd][3];
            zip = adds[rndAdd][4];
            
            enums[i]=noe;
            zips[i]=zip;
            
            System.out.print("("+(i+s_base)+", \'"+phone+"\', "+noe+", "+street+", "+city+", "+state+", "+zip+")");
            if(i==sNum-1) System.out.println(";");
            else System.out.println(",");
        }
        

        ///////////////
        // employee //
        //////////////
        System.out.println();
        System.out.println();
        
        int [][] stores = new int[sNum][MAX_EMPOL];

        System.out.println("INSERT INTO `employees` (`employee_id`, `store_id`, `first_name`, `last_name`, `email`, `job_title`, `salary`) VALUES");
        
        String title = "manager";
        int salary = 0;
        
        for (int i=0;i<sNum;i++){
            for (int j=0;j<enums[i];j++){
                if(j==0){
                    title = "manager";
                    salary = (int)(Math.random() * 50000 + 50000);
                } else {
                    title = "sales assistant";
                    salary = (int)(Math.random() * 20000 + 30000);
                }
                
                int rndfn = (int)(Math.random() * MAX_NAME);
                int rndln = (int)(Math.random() * MAX_NAME);
                String fn = names[rndfn][0];
                String ln = names[rndln][1];
                String email = fn+"."+ln+""+(int)(Math.random() * 100)+"@pittmart.com";
                
                System.out.print("("+eid+", "+(i+s_base)+", \'"+fn+"\', \'"+ln+"\', \'"+email.toLowerCase()+"\', \'"+title+"\', \'$"+salary+"\')");
                if(i==sNum-1 && j==enums[i]-1) System.out.println(";");
                else System.out.println(",");
                stores[i][j]=eid;
                eid++;
            }
            
        }

        ///////////////
        // custormer //
        ///////////////
        System.out.println();
        System.out.println();

        int cadd[] = new int[cNum]; // address index
        String bcs[] = {"IT", "Finance", "Restaurant", "Education", "Others"};
        System.out.println("INSERT INTO `customers` (`customer_id`, `first_name`, `last_name`, `password`, `phone_number`, `email`, `street`, `city`, `state`, `zip`, `home_or_business`, `business_category`, `annual_income`, `married`, `gender`, `birth_year`) VALUES");
        
        for (int i=0;i<cNum;i++){
            
            int rndfn = (int)(Math.random() * MAX_NAME);
            int rndln = (int)(Math.random() * MAX_NAME);
            String fn = names[rndfn][0];
            String ln = names[rndln][1];
            String password = getMd5(fn);
            long phone = (long)(Math.random() * 8999999999L + 1000000000L);
            String email = fn+"."+ln+""+(int)(Math.random() * 100)+"@pittmart.com";
            
            int rndAdd = (int)(Math.random() * MAX_ADD);
            cadd[i]=rndAdd;
            street = adds[rndAdd][0];
            city = adds[rndAdd][2];
            state = adds[rndAdd][3];
            zip = adds[rndAdd][4];
            
            int rndHoB = (int)(Math.random() * 10);
            String hob = "home";
            int income = (int)(Math.random() * 100000 +20000);
            String bc = "NULL";
            if (rndHoB%2==0){
                hob = "business";
                int rndB = (int)(Math.random() * 5);
                bc = bcs[rndB];
                income = (int)(Math.random() * 10000000);
            }
            
            int rndg = (int)(Math.random() * 10);
            String gender = "female";
            if (rndg%2==0){
                gender = "male";
            }
            
            int rndm = (int)(Math.random() * 10);
            String married = "no";
            if (rndg%2==0){
                married = "yes";
            }
            
            
            int by = (int)(Math.random() * 60 +1950);
            
            System.out.print("("+(i+c_base)+", \'"+fn+"\', \'"+ln+"\', \'"+password+"\', \'"+phone+"\', \'"+email.toLowerCase()+"\', "+street+", "+city+", "+state+", "+zip+", \'"+hob+"\', \'"+bc+"\', \'"+income+"\', \'"+married+"\', \'"+gender+"\', "+by+")");
            if(i==cNum-1) System.out.println(";");
            else System.out.println(",");
            
            
        }
        
        /////////////
        // order  //
        ////////////
        
        System.out.println();
        System.out.println();


        System.out.println("INSERT INTO `order_detail` (`order_detail_id`, `o_id`, `p_id`, `c_id`, `qty`, `store_id`, `employee_id`, `shipping_st`, `city`, `state`, `zip`, `time`) VALUES");
        
        int pid=0,cid=0,qty=0,sid=0;
        long oid=0;
        
        //Timestamp timestamp = new Timestamp(System.currentTimeMillis());
        //oid = timestamp.getTime();
        oid = 1514782800; // 2018-1-1
        SimpleDateFormat dateFormat = new SimpleDateFormat("YYYY-MM-dd HH:mm:ss");
        String time = dateFormat.format(new Date(oid*1000));

        for (int i=0;i<oNum;i++){
            int rndAdd = (int)(Math.random() * MAX_ADD);
            int rndItems = (int)(Math.random() * MAX_ORDER);
            cid = (int)(Math.random() * cNum);
            
            int rndc = (int)(Math.random() * 10);
            // use custormer's home address
            if (rndc%2==0){
                rndAdd = cadd[cid];
            }
            
            street = adds[rndAdd][0];
            city = adds[rndAdd][2];
            state = adds[rndAdd][3];
            zip = adds[rndAdd][4];
            time = dateFormat.format(new Date(oid*1000));
            
            // find a store
            
            int min = 100000000;
            for (int k = 0;k<sNum;k++){
                int diff = Math.abs(Integer.parseInt(zip.substring(1,6))-Integer.parseInt(zips[k].substring(1,6)));
                if(diff < min){
                    sid = k;
                    min = diff;
                }
            }
            
            // allocate an employee
            
            int rnde = (int)(Math.random() * enums[sid]);
            eid = stores[sid][rnde];
            
            for(int j=0;j<rndItems;j++){
                pid = (int)(Math.random() * MAX_PROD+1);
                qty = (int)(Math.random() * MAX_QTY);
                System.out.print("(NULL, "+oid+", "+pid+", "+(cid+c_base)+", "+qty+", "+(sid+s_base)+", "+eid+", "+street+", "+city+", "+state+", "+zip+", \'"+time+"\')");
                if(i==oNum-1 && j==rndItems-1) System.out.println(";");
                else System.out.println(",");
            }
            oid += getNext();
        }
    }
}
