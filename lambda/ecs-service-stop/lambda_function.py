import boto3
import json

client = boto3.client("ecs", region_name="eu-central-1")
# function to set desired task count to 0
def lambda_handler(event, context):
    response1 = client.update_service(cluster="tto-ecs", service="timesync-fe_service", desiredCount=0)
    response2 = client.update_service(cluster="tto-ecs", service="timesync-api_service", desiredCount=0)
    print(json.dumps(response1,indent=4, default=str))
    print(json.dumps(response2,indent=4, default=str))