"""
Python script to extract csv file into new csv file according to our database format
"""
import random
import pandas as pd
import os

"""
Remove the first 4 rows from the csv file
"""
csv1 = pd.read_csv("CMP_1_EXCEL_EXPORT_ND-18 - Sheet1.csv")
csv2 = pd.read_csv("ETRX_1_EXCEL_EXPORT_ND-18 - Sheet1.csv")
csv3 = pd.read_csv("EXTC_1_EXCEL_EXPORT_ND-18 - Sheet1.csv")
csv4 = pd.read_csv("IT_1_EXCEL_EXPORT_ND-18 - Sheet1.csv")
csv5 = pd.read_csv("MECH_A1_EXCEL_EXPORT_ND-18 - Sheet1.csv")
csv6 = pd.read_csv("MECH_B1_EXCEL_EXPORT_ND-18 - Sheet1.csv")
dataset = [csv1, csv2, csv3, csv4, csv5, csv6]


def student_cgpa():
    columns = ['seat_no', 'credit_points', 'gpa', 'total_semester_marks']
    for df in dataset:
        data = df[["seatno", "ECPGP", "GPA", "ExamTotal"]].iloc[4:]
        if not os.path.isfile('student_cgpa.csv'):
            data.to_csv('student_cgpa.csv', header=columns, index=False)
        else:
            data.to_csv('student_cgpa.csv', mode='a', header=False, index=False)


def student_practical_marks():
    """
    columns exam37, exam53, exam57, exam61, exam65, exam69 consists of termwork marks
    columns exam39, exam55, exam59, exam63, exam67, exam71 consists of oral marks
    columns exam40, exam56, exam60, exam64, exam68, exam72 consists of total practical marks
    """
    for df in dataset:
        course = df["exam37"].iloc[:1].values[0]
        course_list = [course] * len(df.iloc[4:])
        data = df[["seatno", "exam37", "exam39", "exam40"]].iloc[4:]
        data.insert(1, "course_id", course_list)
        data.to_csv('student_practical_marks.csv', mode='a', header=False, index=False)

        course = df["exam53"].iloc[:1].values[0]
        course_list = [course] * len(df.iloc[4:])
        data = df[["seatno", "exam53", "exam55", "exam56"]].iloc[4:]
        data.insert(1, "course_id", course_list)
        data.to_csv('student_practical_marks.csv', mode='a', header=False, index=False)

        course = df["exam57"].iloc[:1].values[0]
        course_list = [course] * len(df.iloc[4:])
        data = df[["seatno", "exam57", "exam59", "exam60"]].iloc[4:]
        data.insert(1, "course_id", course_list)
        data.to_csv('student_practical_marks.csv', mode='a', header=False, index=False)

        course = df["exam61"].iloc[:1].values[0]
        course_list = [course] * len(df.iloc[4:])
        data = df[["seatno", "exam61", "exam63", "exam64"]].iloc[4:]
        data.insert(1, "course_id", course_list)
        data.to_csv('student_practical_marks.csv', mode='a', header=False, index=False)

        course = df["exam65"].iloc[:1].values[0]
        course_list = [course] * len(df.iloc[4:])
        data = df[["seatno", "exam65", "exam67", "exam68"]].iloc[4:]
        data.insert(1, "course_id", course_list)
        data.to_csv('student_practical_marks.csv', mode='a', header=False, index=False)

        course = df["exam69"].iloc[:1].values[0]
        course_list = [course] * len(df.iloc[4:])
        data = df[["seatno", "exam69", "exam71", "exam72"]].iloc[4:]
        data.insert(1, "course_id", course_list)
        data.to_csv('student_practical_marks.csv', mode='a', header=False, index=False)


def student_theory_marks():
    """
    columns exam1, exam4, exam7, exam10 exam69 consists of ESE marks
    columns exam2, exam5, exam8, exam11 consists of CA marks
    columns exam3, exam6, exam9, exam12 consists of total theory marks
    """
    for df in dataset:
        course = df["exam1"].iloc[:1].values[0]
        course_list = [course] * len(df.iloc[4:])
        data = df[["seatno", "exam1", "exam2", "exam3"]].iloc[4:]
        data.insert(1, "course_id", course_list)
        data.to_csv('student_theory_marks.csv', mode='a', header=False, index=False)

        course = df["exam4"].iloc[:1].values[0]
        course_list = [course] * len(df.iloc[4:])
        data = df[["seatno", "exam4", "exam5", "exam6"]].iloc[4:]
        data.insert(1, "course_id", course_list)
        data.to_csv('student_theory_marks.csv', mode='a', header=False, index=False)

        course = df["exam7"].iloc[:1].values[0]
        course_list = [course] * len(df.iloc[4:])
        data = df[["seatno", "exam7", "exam8", "exam9"]].iloc[4:]
        data.insert(1, "course_id", course_list)
        data.to_csv('student_theory_marks.csv', mode='a', header=False, index=False)

        course = df["exam10"].iloc[:1].values[0]
        course_list = [course] * len(df.iloc[4:])
        data = df[["seatno", "exam10", "exam11", "exam12"]].iloc[4:]
        data.insert(1, "course_id", course_list)
        data.to_csv('student_theory_marks.csv', mode='a', header=False, index=False)


def generate_second_year_data():
    start_seat_no = 31711001
    random_data = []
    """
    generating student_cgpa_data
    """
    for i in range(610):
        if i % 10 == 0:
            credit_points = random.randint(70, 110)
            random_data.append([start_seat_no + 1, credit_points, "--", random.randint(260, 440)])
        else:
            credit_points = random.randint(155, 208)
            random_data.append([start_seat_no + 1, credit_points, round(credit_points/22, 2), random.randint(450, 606)])
    data = pd.DataFrame(random_data)
    data.to_csv('student_cgpa.csv', mode='a', header=False, index=False)

    start_seat_no = 31711001
    random_data = []
    """
    generating student practical data
    """
    course_list = ['COURSE-1', 'COURSE-5', 'COURSE-6', 'COURSE-7', 'COURSE-8', 'COURSE-9']
    for items in course_list:
        for i in range(610):
            if items == 'COURSE-1':
                tw_marks = random.randint(18, 24)
                random_data.append([start_seat_no + i, items, tw_marks, "", tw_marks])
            elif items == 'COURSE-5':
                tw_marks = random.randint(60, 100)
                random_data.append([start_seat_no + i, items, tw_marks, "", tw_marks])
            elif items == 'COURSE-7':
                tw_marks = random.randint(27, 50)
                random_data.append([start_seat_no + i, items, tw_marks, "", tw_marks])
            elif items == 'COURSE-6':
                tw_marks = random.randint(18, 24)
                oral_marks = random.randint(15, 23)
                random_data.append([start_seat_no + i, items, tw_marks, oral_marks, tw_marks + oral_marks])
            elif items == 'COURSE-8':
                tw_marks = random.randint(18, 24)
                oral_marks = random.randint(15, 23)
                random_data.append([start_seat_no + i, items, tw_marks, oral_marks, tw_marks + oral_marks])
            elif items == 'COURSE-9':
                tw_marks = random.randint(26, 50)
                random_data.append([start_seat_no + i, items, tw_marks, "", tw_marks])
        data = pd.DataFrame(random_data)
        data.to_csv('student_practical_marks.csv', mode='a', header=False, index=False)

        start_seat_no = 31711001
        random_data = []
        """
        generating student theory data
        """
        course_list = ['COURSE-1', 'COURSE-2', 'COURSE-3', 'COURSE-4']
        for items in course_list:
            for i in range(610):
                ese_marks = random.randint(22, 50)
                ca_marks = random.randint(25, 50)
                random_data.append([start_seat_no + i, items, ese_marks, ca_marks, ese_marks + ca_marks])
        data = pd.DataFrame(random_data)
        data.to_csv('student_theory_marks.csv', mode='a', header=False, index=False)


def generate_third_year_data():
    start_seat_no = 51611022
    random_data = []
    """
        generating student_cgpa_data
    """
    for i in range(610):
        if i % 10 == 0:
            credit_points = random.randint(70, 110)
            random_data.append([start_seat_no + 1, credit_points, "--", random.randint(260, 440)])
        else:
            credit_points = random.randint(155, 208)
            random_data.append([start_seat_no + 1, credit_points, round(credit_points/22, 2), random.randint(450, 606)])
    data = pd.DataFrame(random_data)
    data.to_csv('student_cgpa.csv', mode='a', header=False, index=False)

    start_seat_no = 51611001
    random_data = []
    """
    generating student practical data
    """
    course_list = ['COURSE-1', 'COURSE-5', 'COURSE-6', 'COURSE-7', 'COURSE-8', 'COURSE-9']
    for items in course_list:
        for i in range(610):
            if items == 'COURSE-1':
                tw_marks = random.randint(18, 24)
                random_data.append([start_seat_no + i, items, tw_marks, "", tw_marks])
            elif items == 'COURSE-5':
                tw_marks = random.randint(60, 100)
                random_data.append([start_seat_no + i, items, tw_marks, "", tw_marks])
            elif items == 'COURSE-7':
                tw_marks = random.randint(27, 50)
                random_data.append([start_seat_no + i, items, tw_marks, "", tw_marks])
            elif items == 'COURSE-6':
                tw_marks = random.randint(18, 24)
                oral_marks = random.randint(15, 23)
                random_data.append([start_seat_no + i, items, tw_marks, oral_marks, tw_marks + oral_marks])
            elif items == 'COURSE-8':
                tw_marks = random.randint(18, 24)
                oral_marks = random.randint(15, 23)
                random_data.append([start_seat_no + i, items, tw_marks, oral_marks, tw_marks + oral_marks])
            elif items == 'COURSE-9':
                tw_marks = random.randint(26, 50)
                random_data.append([start_seat_no + i, items, tw_marks, "", tw_marks])
        data = pd.DataFrame(random_data)
        data.to_csv('student_practical_marks.csv', mode='a', header=False, index=False)

        start_seat_no = 51611001
        random_data = []
        """
        generating student theory data
        """
        course_list = ['COURSE-1', 'COURSE-2', 'COURSE-3', 'COURSE-4']
        for items in course_list:
            for i in range(610):
                ese_marks = random.randint(22, 50)
                ca_marks = random.randint(25, 50)
                random_data.append([start_seat_no + i, items, ese_marks, ca_marks, ese_marks + ca_marks])
        data = pd.DataFrame(random_data)
        data.to_csv('student_theory_marks.csv', mode='a', header=False, index=False)


def generate_fourth_year_data():
    start_seat_no = 71511022
    """
        generating student_cgpa_data
    """
    random_data = []
    for i in range(121):
        if i % 10 == 0:
            credit_points = random.randint(70, 110)
            random_data.append([start_seat_no + 1, credit_points, "--", random.randint(260, 440)])
        else:
            credit_points = random.randint(155, 208)
            random_data.append([start_seat_no + 1, credit_points, round(credit_points/22, 2), random.randint(450, 606)])
    data = pd.DataFrame(random_data)
    data.to_csv('student_cgpa.csv', mode='a', header=False, index=False)

    start_seat_no = 71511001
    random_data = []
    """
    generating student practical data
    """
    course_list = ['COURSE-1', 'COURSE-5', 'COURSE-6', 'COURSE-7', 'COURSE-8', 'COURSE-9']
    for items in course_list:
        for i in range(610):
            if items == 'COURSE-1':
                tw_marks = random.randint(18, 24)
                random_data.append([start_seat_no + i, items, tw_marks, "", tw_marks])
            elif items == 'COURSE-5':
                tw_marks = random.randint(60, 100)
                random_data.append([start_seat_no + i, items, tw_marks, "", tw_marks])
            elif items == 'COURSE-7':
                tw_marks = random.randint(27, 50)
                random_data.append([start_seat_no + i, items, tw_marks, "", tw_marks])
            elif items == 'COURSE-6':
                tw_marks = random.randint(18, 24)
                oral_marks = random.randint(15, 23)
                random_data.append([start_seat_no + i, items, tw_marks, oral_marks, tw_marks + oral_marks])
            elif items == 'COURSE-8':
                tw_marks = random.randint(18, 24)
                oral_marks = random.randint(15, 23)
                random_data.append([start_seat_no + i, items, tw_marks, oral_marks, tw_marks + oral_marks])
            elif items == 'COURSE-9':
                tw_marks = random.randint(26, 50)
                random_data.append([start_seat_no + i, items, tw_marks, "", tw_marks])
        data = pd.DataFrame(random_data)
        data.to_csv('student_practical_marks.csv', mode='a', header=False, index=False)

        start_seat_no = 71511001
        random_data = []
        """
        generating student theory data
        """
        course_list = ['COURSE-1', 'COURSE-2', 'COURSE-3', 'COURSE-4']
        for items in course_list:
            for i in range(610):
                ese_marks = random.randint(22, 50)
                ca_marks = random.randint(25, 50)
                random_data.append([start_seat_no + i, items, ese_marks, ca_marks, ese_marks + ca_marks])
        data = pd.DataFrame(random_data)
        data.to_csv('student_theory_marks.csv', mode='a', header=False, index=False)


if __name__ == "__main__":
    # student_cgpa()
    # student_practical_marks()
    # student_theory_marks()
    generate_second_year_data()
    generate_third_year_data()
    pass
