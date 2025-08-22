import java.util.Scanner;
public class Main {
    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);
        // Ask the user for input
        int n = scanner.nextInt();  // Read user input
        // Print "Hello" n times
        for (int i = 0; i < n; i++) {
            System.out.println("hello");
        }        
        scanner.close();  // Close the scanner
    }
}