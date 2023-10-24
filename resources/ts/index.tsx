import React, {useState} from 'react';
import {
    Text,
    MantineProvider,
    Stack,
    TextInput,
    Title,
    Button,
    ActionIcon,
    Slider,
    Menu,
    ScrollArea
} from "@mantine/core";
import '@mantine/core/styles.css';
import axios from "axios";
import Label = Menu.Label;

export const App = () => {
    const [system, setSystem] = useState('');
    const [userInput, setUserInput] = useState([]);
    const [responses, setResponses] = useState([]);
    const [activeInput, setActiveInput] = useState('');
    const [activeIndex, setActiveIndex] = useState(0);
    const [temp, setTemp] = useState(0.5);

    function generatePayload() {
        let arrayOfMessages = [
            {role: 'system', content: system}
        ]
        for (let i = 0; i <= responses.length; i++) {
            if (typeof userInput[i] !== 'undefined') {
                arrayOfMessages.push({role: 'user', content: userInput[i]});
            }
            if (typeof responses[i] !== 'undefined') {
                arrayOfMessages.push({role: 'assistant', content: responses[i]});
            }
        }
        arrayOfMessages.push({role: 'user', content: activeInput});
        return arrayOfMessages;
    }

    const askChatGPT = async () => {
        const payload = generatePayload();
        const response = await axios.post('http://localhost:8083/api/chatGPT/ask', {
            prompt: payload,
            temp: temp / 100
        }).then(r => r.data)
        let responsesArray = responses;
        responsesArray.push(response.message);
        setResponses(responsesArray);
        let newUserInputArray = userInput;
        newUserInputArray.push(activeInput);
        setUserInput(newUserInputArray);
        setActiveIndex(activeIndex + 1)
        setActiveInput('');
    }

    const resetState = () => {
        setSystem('');
        setUserInput([]);
        setResponses([]);
        setActiveInput('');
        setActiveIndex(0);
    }

    return (
        <MantineProvider defaultColorScheme={"dark"}>
            <Stack justify="center" align='center'>
                <Title>ChatGPT Demo</Title>
                <TextInput value={system} onChange={(event) => setSystem(event.currentTarget.value)}
                           disabled={responses.length > 0} w={600} label="System"/>
                <TextInput value={activeIndex === 0 ? activeInput : userInput[0]}
                           onChange={(event) => setActiveInput(event.currentTarget.value)}
                           disabled={responses.length > 0} w={600} label="User"/>
                {responses?.map((response, index) => <>
                    <Text>Response</Text>
                    <ScrollArea w={600} h={200}>
                        <Text ta='start'>
                            {response}
                        </Text>
                    </ScrollArea>
                    <TextInput disabled={(index + 1) < activeIndex}
                               value={activeIndex === (index + 1) ? activeInput : userInput[index + 1]}
                               onChange={(event) => setActiveInput(event.currentTarget.value)}
                               w={600} label="User"/>
                </>)}
                <Text size="x">Temperature</Text>
                <Slider w={600} value={temp} color="blue" marks={[
                    {value: 20, label: '.2'},
                    {value: 50, label: '.5'},
                    {value: 80, label: '.8'},
                ]} onChange={setTemp} mb={10}/>
                <Button onClick={askChatGPT}>Ask ChatGPT</Button>
                <Button onClick={resetState}>Reset</Button>
            </Stack>
        </MantineProvider>
    );
}
