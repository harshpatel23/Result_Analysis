"""
Python script to extract csv file into new csv file according to our database format
"""
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


if __name__ == "__main__":
    # student_cgpa()
    # student_practical_marks()
    # student_theory_marks()
    pass
