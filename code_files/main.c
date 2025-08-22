#include<stdio.h>
int main()
{
  int a;
  scanf("%d",&a);
  for(int i=0;i<=a;i++)
  {
    if(i==3)
    {
      printf("Values Matched\n");
      printf("%d",i);
      break;
    }
  }
  return 0;
}