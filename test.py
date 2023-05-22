def remove_words_from_file(file_path, words):
    with open(file_path, 'r') as file:
        content = file.read()

    for word in words:
        content = content.replace(word, '')

    with open(file_path, 'w') as file:
        file.write(content)

# File path of the notes file
notes_file_path = './Industries.txt'

# Words to remove from the file
words_to_remove = ['Includeren', 'Excluderen']

remove_words_from_file(notes_file_path, words_to_remove)
