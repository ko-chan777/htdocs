import mysql.connector

cnx = None


print("星座を入力して下さい。")
seiza = input('>> ')



try:
    print(seiza + "が入力されました。")
    cnx = mysql.connector.connect(
        user='sendaimirai_mibu',  # ユーザー名
        password='ksj1010ksj',  # パスワード
        host='mysql8047.xserver.jp',  # ホスト名(IPアドレス）
        database='sendaimirai_cr7'  # データベース名
    )

    cursor = cnx.cursor()

    sql = ('''
    SELECT  id, horo, horosetsumei
    FROM    horoscorp
    WHERE   horo = %s
    ''')


    param = (seiza,)

    cursor.execute(sql, param)

    for (id, horo, horosetusmei) in cursor:
        print(f"{id} {horo} {horosetusmei}")

    cursor.close()

except Exception as e:
    print(f"Error Occurred: {e}")

finally:
    if cnx is not None and cnx.is_connected():
        cnx.close()